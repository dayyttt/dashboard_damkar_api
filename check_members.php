<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== CHECKING MEMBERS IN DATABASE ===\n\n";

$members = \App\Models\Member::select('nip', 'name', 'regu', 'jabatan')
    ->orderBy('id')
    ->limit(10)
    ->get();

echo "Total members found: " . $members->count() . "\n\n";

foreach ($members as $member) {
    echo "NIP: {$member->nip}\n";
    echo "Name: {$member->name}\n";
    echo "Regu: {$member->regu}\n";
    echo "Jabatan: {$member->jabatan}\n";
    echo "---\n";
}

echo "\n=== CHECKING SPECIFIC NIP ===\n\n";

$testNip = '198501012010011001';
$testMember = \App\Models\Member::where('nip', $testNip)->first();

if ($testMember) {
    echo "✅ Member found!\n";
    echo "NIP: {$testMember->nip}\n";
    echo "Name: {$testMember->name}\n";
    echo "Password Hash: " . substr($testMember->password, 0, 20) . "...\n";
    echo "Is Active: " . ($testMember->is_active ? 'Yes' : 'No') . "\n";
} else {
    echo "❌ Member NOT found with NIP: {$testNip}\n";
}
