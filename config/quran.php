<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Storage path
    |--------------------------------------------------------------------------
    |
    | Set storage path where all translation will be stored.
    | This path will be created inside /storage/app directory.
    |
    */

    'storage_path' => 'quran',

    /*
    |--------------------------------------------------------------------------
    | Output limit
    |--------------------------------------------------------------------------
    |
    | Set the limit for ayah and translation
    |
    */

    'limit' => [
        'ayah' => 15,
        'translation' => 3,
    ],

    /*
    |--------------------------------------------------------------------------
    | Translations provided by tanzil
    |--------------------------------------------------------------------------
    |
    | Set translations that will be available for this package. Translations
    | need to be downloaded first before used. You can set multi translations
    | using array below.
    |
    | Supported:
    |
    | "sq.nahi"     => (Albanian), Efendi Nahi by Hasan Efendi Nahi
    | "sq.mehdiu"   => (Albanian), Feti Mehdiu by Feti Mehdiu
    | "sq.ahmeti"   => (Albanian), Sherif Ahmeti by Sherif Ahmeti
    | "ber.mensur"  => (Amazigh), At Mensur by Ramdane At Mansour
    | "ar.jalalayn" => (Arabic), تفسير الجلالين by Jalal ad-Din al-Mahalli and Jalal ad-Din as-Suyuti
    | "ar.muyassar" => (Arabic), تفسير المیسر by King Fahad Quran Complex
    | "am.sadiq"    => (Amharic), ሳዲቅ & ሳኒ ሐቢብ by Muhammed Sadiq and Muhammed Sani Habib
    | "az.mammadaliyev" => (Azerbaijani), Məmmədəliyev & Bünyadov by Vasim Mammadaliyev and Ziya Bunyadov
    | "az.musayev"  => (Azerbaijani), Musayev by Alikhan Musayev
    | "bn.hoque"    => (Bengali), জহুরুল হক by Zohurul Hoque
    | "bn.bengali"  => (Bengali), মুহিউদ্দীন খান by Muhiuddin Khan
    | "bs.korkut"   => (Bosnian), Korkut by Besim Korkut
    | "bs.mlivo"    => (Bosnian), Mlivo by Mustafa Mlivo
    | "bg.theophanov" => (Bulgarian), Теофанов by Tzvetan Theophanov
    | "zh.jian"     => (Chinese), Ma Jian by Ma Jian
    | "zh.majian"   => (Chinese), Ma Jian (Traditional) by Ma Jian
    | "cs.hrbek"    => (Czech), Hrbek by Preklad I. Hrbek
    | "cs.nykl"     => (Czech), Nykl by A. R. Nykl
    | "dv.divehi"   => (Divehi), ދިވެހި by Office of the President of Maldives
    | "nl.keyzer"   => (Dutch), Keyzer by Salomo Keyzer
    | "nl.leemhuis" => (Dutch), Leemhuis by Fred Leemhuis
    | "nl.siregar"  => (Dutch), Siregar by Sofian S. Siregar
    | "en.ahmedali" => (English), Ahmed Ali by Ahmed Ali
    | "en.ahmedraza" => (English), Ahmed Raza Khan by Ahmed Raza Khan
    | "en.arberry"  => (English), Arberry by A. J. Arberry
    | "en.daryabadi" => (English), Daryabadi by Abdul Majid Daryabadi
    | "en.hilali"   => (English), Hilali & Khan by Muhammad Taqi-ud-Din al-Hilali and Muhammad Muhsin Khan
    | "en.itani"    => (English), Itani by Talal Itani
    | "en.maududi"  => (English), Maududi by Abul Ala Maududi
    | "en.mubarakpuri" => (English), Mubarakpuri by Safi-ur-Rahman al-Mubarakpuri
    | "en.pickthall" => (English), Pickthall by Mohammed Marmaduke William Pickthall
    | "en.qarai"    => (English), Qarai by Ali Quli Qarai
    | "en.qaribullah" => (English), Qaribullah & Darwish by Hasan al-Fatih Qaribullah and Ahmad Darwish
    | "en.sahih"    => (English), Saheeh International by Saheeh International
    | "en.sarwar"   => (English), Sarwar by Muhammad Sarwar
    | "en.shakir"   => (English), Shakir by Mohammad Habib Shakir
    | "en.transliteration" => (English), Transliteration by English Transliteration
    | "en.wahiduddin" => (English), Wahiduddin Khan by Wahiduddin Khan
    | "en.yusufali" => (English), Yusuf Ali by Abdullah Yusuf Ali
    | "fr.hamidullah" => (French), Hamidullah by Muhammad Hamidullah
    | "de.aburida"  => (German), Abu Rida by Abu Rida Muhammad ibn Ahmad ibn Rassoul
    | "de.bubenheim" => (German), Bubenheim & Elyas by A. S. F. Bubenheim and N. Elyas
    | "de.khoury"   => (German), Khoury by Adel Theodor Khoury
    | "de.zaidan"   => (German), Zaidan by Amir Zaidan
    | "ha.gumi"     => (Hausa), Gumi by Abubakar Mahmoud Gumi
    | "hi.farooq"   => (Hindi), फ़ारूक़ ख़ान & अहमद by Muhammad Farooq Khan and Muhammad Ahmed
    | "hi.hindi"    => (Hindi), फ़ारूक़ ख़ान & नदवी by Suhel Farooq Khan and Saifur Rahman Nadwi
    | "id.indonesian" => (Indonesian), Bahasa Indonesia by Indonesian Ministry of Religious Affairs
    | "id.muntakhab" => (Indonesian), Quraish Shihab by Muhammad Quraish Shihab et al.
    | "id.jalalayn" => (Indonesian), Tafsir Jalalayn by Jalal ad-Din al-Mahalli and Jalal ad-Din as-Suyuti
    | "it.piccardo" => (Italian), Piccardo by Hamza Roberto Piccardo
    | "ja.japanese" => (Japanese), Japanese by Unknown
    | "ko.korean"   => (Korean), Korean by Unknown
    | "ku.asan"     => (Kurdish), ته‌فسیری ئاسان by Burhan Muhammad-Amin
    | "ms.basmeih"  => (Malay), Basmeih by Abdullah Muhammad Basmeih
    | "ml.abdulhameed" => (Malayalam), അബ്ദുല്‍ ഹമീദ് & പറപ്പൂര്‍ by Cheriyamundam Abdul Hameed and Kunhi Mohammed Parappoor
    | "ml.karakunnu" => (Malayalam), കാരകുന്ന് & എളയാവൂര് by Muhammad Karakunnu and Vanidas Elayavoor
    | "no.berg"     => (Norwegian), Einar Berg by Einar Berg
    | "ps.abdulwali" => (Pashto), عبدالولي by Abdulwali Khan
    | "fa.ansarian" => (Persian), انصاریان by Hussain Ansarian
    | "fa.ayati"    => (Persian), آیتی by AbdolMohammad Ayati
    | "fa.bahrampour" => (Persian), بهرام پور by Abolfazl Bahrampour
    | "fa.gharaati" => (Persian), قرائتی by Mohsen Gharaati
    | "fa.ghomshei" => (Persian), الهی قمشه‌ای by Mahdi Elahi Ghomshei
    | "fa.khorramdel" => (Persian), خرمدل by Mostafa Khorramdel
    | "fa.khorramshahi" => (Persian), خرمشاهی by Baha'oddin Khorramshahi
    | "fa.sadeqi"   => (Persian), صادقی تهرانی by Mohammad Sadeqi Tehrani
    | "fa.fooladvand" => (Persian), فولادوند by Mohammad Mahdi Fooladvand
    | "fa.mojtabavi" => (Persian), مجتبوی by Sayyed Jalaloddin Mojtabavi
    | "fa.moezzi"   => (Persian), معزی by Mohammad Kazem Moezzi
    | "fa.makarem"  => (Persian), مکارم شیرازی by Naser Makarem Shirazi
    | "pl.bielawskiego" => (Polish), Bielawskiego by Józefa Bielawskiego
    | "pt.elhayek"  => (Portuguese), El-Hayek by Samir El-Hayek
    | "ro.grigore"  => (Romanian), Grigore by George Grigore
    | "ru.abuadel"  => (Russian), Абу Адель by Abu Adel
    | "ru.muntahab" => (Russian), Аль-Мунтахаб by Ministry of Awqaf, Egypt
    | "ru.krachkovsky" => (Russian), Крачковский by Ignaty Yulianovich Krachkovsky
    | "ru.kuliev"   => (Russian), Кулиев by Elmir Kuliev
    | "ru.kuliev-alsaadi" => (Russian), Кулиев + ас-Саади by Elmir Kuliev (with Abd ar-Rahman as-Saadi's commentaries)
    | "ru.osmanov"  => (Russian), Османов by Magomed-Nuri Osmanovich Osmanov
    | "ru.porokhova" => (Russian), Порохова by V. Porokhova
    | "ru.sablukov" => (Russian), Саблуков by Gordy Semyonovich Sablukov
    | "sd.amroti"   => (Sindhi), امروٽي by Taj Mehmood Amroti
    | "so.abduh"    => (Somali), Abduh by Mahmud Muhammad Abduh
    | "es.bornez"   => (Spanish), Bornez by Raúl González Bórnez
    | "es.cortes"   => (Spanish), Cortes by Julio Cortes
    | "es.garcia"   => (Spanish), Garcia by Muhammad Isa García
    | "sw.barwani"  => (Swahili), Al-Barwani by Ali Muhsin Al-Barwani
    | "sv.bernstrom" => (Swedish), Bernström by Knut Bernström
    | "tg.ayati"    => (Tajik), Оятӣ by AbdolMohammad Ayati
    | "ta.tamil"    => (Tamil), ஜான் டிரஸ்ட் by Jan Turst Foundation
    | "tt.nugman"   => (Tatar), Yakub Ibn Nugman by Yakub Ibn Nugman
    | "th.thai"     => (Thai), ภาษาไทย by King Fahad Quran Complex
    | "tr.golpinarli" => (Turkish), Abdulbakî Gölpınarlı by Abdulbaki Golpinarli
    | "tr.bulac"    => (Turkish), Alİ Bulaç by Alİ Bulaç
    | "tr.transliteration" => (Turkish), Çeviriyazı by Muhammet Abay
    | "tr.diyanet"  => (Turkish), Diyanet İşleri by Diyanet Isleri
    | "tr.vakfi"    => (Turkish), Diyanet Vakfı by Diyanet Vakfi
    | "tr.yuksel"   => (Turkish), Edip Yüksel by Edip Yüksel
    | "tr.yazir"    => (Turkish), Elmalılı Hamdi Yazır by Elmalili Hamdi Yazir
    | "tr.ozturk"   => (Turkish), Öztürk by Yasar Nuri Ozturk
    | "tr.yildirim" => (Turkish), Suat Yıldırım by Suat Yildirim
    | "tr.ates"     => (Turkish), Süleyman Ateş by Suleyman Ates
    | "ur.maududi"  => (Urdu), ابوالاعلی مودودی by Abul A'ala Maududi
    | "ur.kanzuliman" => (Urdu), احمد رضا خان by Ahmed Raza Khan
    | "ur.ahmedali" => (Urdu), احمد علی by Ahmed Ali
    | "ur.jalandhry" => (Urdu), جالندہری by Fateh Muhammad Jalandhry
    | "ur.qadri"    => (Urdu), طاہر القادری by Tahir ul Qadri
    | "ur.jawadi"   => (Urdu), علامہ جوادی by Syed Zeeshan Haider Jawadi
    | "ur.junagarhi" => (Urdu), محمد جوناگڑھی by Muhammad Junagarhi
    | "ur.najafi"   => (Urdu), محمد حسین نجفی by Muhammad Hussain Najafi
    | "ug.saleh"    => (Uyghur), محمد صالح by Muhammad Saleh
    | "uz.sodik"    => (Uzbek), Мухаммад Содик by Muhammad Sodik Muhammad Yusuf
    |
    */

    'translations' => ['en.sahih'],
];
