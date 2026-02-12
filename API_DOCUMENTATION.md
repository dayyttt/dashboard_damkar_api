# API Documentation - Damkar Attendance System

Base URL: `http://127.0.0.1:8000/api`

## Authentication

All protected endpoints require Bearer token in header:
```
Authorization: Bearer {token}
```

---

## 1. Login

**POST** `/login`

Request:
```json
{
  "nip": "198501012010011001",
  "password": "12345"
}
```

Response Success (200):
```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "token": "1|abc123...",
    "user": {
      "id": 1,
      "nip": "198501012010011001",
      "nama": "Budi Santoso",
      "email": "budi@damkar.jakarta.go.id",
      "phone": "081234567890",
      "jabatan": "Komandan Regu",
      "regu": "A",
      "sektor": "Sektor Pusat",
      "sector_id": 1,
      "photo": null
    }
  }
}
```

Response Error (401):
```json
{
  "success": false,
  "message": "NIP atau password salah"
}
```

---

## 2. Get Settings

**GET** `/settings`

No authentication required.

Response (200):
```json
{
  "success": true,
  "data": {
    "location": {
      "latitude": -6.200000,
      "longitude": 106.816666,
      "address": "Jakarta Pusat",
      "radius": 100
    },
    "schedule": {
      "morning": {
        "start": "07:00",
        "end": "08:00"
      },
      "night": {
        "start": "19:00",
        "end": "20:00"
      },
      "checkout": {
        "start": "16:00",
        "end": "17:00"
      }
    }
  }
}
```

---

## 3. Validate Attendance

**POST** `/attendance/validate`

**Requires Authentication**

Check if user can check in (location, time, already checked in).

Request:
```json
{
  "session": "Pagi",
  "latitude": -6.200123,
  "longitude": 106.816789
}
```

Response (200):
```json
{
  "success": true,
  "data": {
    "can_check_in": true,
    "location": {
      "is_valid": true,
      "distance": 45,
      "max_distance": 100,
      "message": "Anda berada di area absen"
    },
    "time": {
      "is_valid": true,
      "current": "07:30",
      "start": "07:00",
      "end": "08:00",
      "message": "Waktu absen masih berlaku"
    },
    "already_checked_in": false,
    "message": "Anda dapat melakukan absensi"
  }
}
```

---

## 4. Submit Attendance

**POST** `/attendance`

**Requires Authentication**

**Validations:**
- Location must be within allowed radius (geofencing)
- Time must be within session schedule
- Cannot check in twice for same session
- Status "Izin" or "Sakit" bypass location validation

Request (multipart/form-data):
```
session: "Pagi" | "Malam" | "Pulang"
latitude: -6.200123
longitude: 106.816789
photo: [file]
status: "Hadir" | "Izin" | "Sakit"
notes: "Optional notes"
location_address: "Jl. Example No. 123"
```

Response Success (200):
```json
{
  "success": true,
  "message": "Absensi berhasil disimpan",
  "data": {
    "id": 1,
    "date": "2026-02-12",
    "session": "Pagi",
    "time": "07:30:00",
    "status": "Hadir"
  }
}
```

Response Error (422):
```json
{
  "success": false,
  "message": "Anda berada di luar area absen. Jarak Anda: 250 meter (maksimal: 100 meter)",
  "data": {
    "distance": 250,
    "max_distance": 100,
    "office_location": {
      "latitude": -6.200000,
      "longitude": 106.816666
    }
  }
}
```

Or:
```json
{
  "success": false,
  "message": "Waktu absen Pagi adalah 07:00 - 08:00. Sekarang: 09:30",
  "data": {
    "current_time": "09:30",
    "allowed_start": "07:00",
    "allowed_end": "08:00"
  }
}
```

Or:
```json
{
  "success": false,
  "message": "Anda sudah absen untuk sesi Pagi hari ini"
}
```

---

## 5. Get Attendance History

**GET** `/attendance/history`

**Requires Authentication**

Response (200):
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "date": "2026-02-12",
      "session": "Pagi",
      "check_in_time": "07:30:00",
      "status": "Hadir",
      "photo": "http://127.0.0.1:8000/storage/attendance-photos/abc.jpg",
      "location": "Jl. Example No. 123",
      "notes": null
    }
  ]
}
```

---

## 6. Get Today's Attendance

**GET** `/attendance/today`

**Requires Authentication**

Response (200):
```json
{
  "success": true,
  "data": {
    "date": "2026-02-12",
    "attendances": [
      {
        "session": "Pagi",
        "time": "07:30:00",
        "status": "Hadir"
      }
    ],
    "completed_sessions": ["Pagi"]
  }
}
```

---

## 7. Get Profile

**GET** `/profile`

**Requires Authentication**

Response (200):
```json
{
  "success": true,
  "data": {
    "id": 1,
    "nip": "198501012010011001",
    "nama": "Budi Santoso",
    "email": "budi@damkar.jakarta.go.id",
    "phone": "081234567890",
    "jabatan": "Komandan Regu",
    "regu": "A",
    "sektor": "Sektor Pusat",
    "sector_id": 1,
    "photo": null,
    "join_date": "2010-01-01",
    "address": "Jakarta"
  }
}
```

---

## 8. Logout

**POST** `/logout`

**Requires Authentication**

Response (200):
```json
{
  "success": true,
  "message": "Logout berhasil"
}
```

---

## Error Responses

### 401 Unauthorized
```json
{
  "message": "Unauthenticated."
}
```

### 422 Validation Error
```json
{
  "message": "The given data was invalid.",
  "errors": {
    "nip": ["The nip field is required."]
  }
}
```

### 500 Server Error
```json
{
  "message": "Server Error"
}
```
