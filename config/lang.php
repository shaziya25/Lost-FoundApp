<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$lang = $_SESSION['lang'] ?? 'en';

$translations = [

'en' => [
    'dashboard'=>'Dashboard',
    'post'=>'Post',
    'browse'=>'Browse',
    'inbox'=>'Inbox',
    'logout'=>'Logout',
    'search'=>'Search',
    'search_items'=>'Search items...',
    'claim'=>'Claim',
    'chat'=>'Chat',
    'contact_owner'=>'Contact Owner',
    'otp'=>'OTP Verification',
    'verify'=>'Verify',
    'no_claims'=>'No claims yet',
    'edit'=>'Edit',
    'delete'=>'Delete'
],

'hi' => [
    'dashboard'=>'डैशबोर्ड',
    'post'=>'पोस्ट',
    'browse'=>'खोजें',
    'inbox'=>'इनबॉक्स',
    'logout'=>'लॉगआउट',
    'search'=>'खोजें',
    'search_items'=>'आइटम खोजें...',
    'claim'=>'दावा करें',
    'chat'=>'चैट',
    'contact_owner'=>'मालिक से संपर्क करें',
    'otp'=>'ओटीपी सत्यापन',
    'verify'=>'सत्यापित करें',
    'no_claims'=>'कोई दावा नहीं',
    'edit'=>'संपादित करें',
    'delete'=>'हटाएं'
]
];

// SAFE FUNCTION
if (!function_exists('t')) {
    function t($key){
        global $translations, $lang;
        return $translations[$lang][$key] ?? $key;
    }
}