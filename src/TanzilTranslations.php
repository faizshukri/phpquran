<?php

namespace FaizShukri\Quran;

class TanzilTranslations
{

    /**
     * Get all translations that are available in tanzil
     *
     * @param string|null $translation_id
     * @return array
     */
    public function get($translation_id = null)
    {
        $translations = [
            [
                "id" => "sq.nahi",
                "language" => "Albanian",
                "name" => "Efendi Nahi",
                "translator" => "Hasan Efendi Nahi"
            ],
            [
                "id" => "sq.mehdiu",
                "language" => "Albanian",
                "name" => "Feti Mehdiu",
                "translator" => "Feti Mehdiu"
            ],
            [
                "id" => "sq.ahmeti",
                "language" => "Albanian",
                "name" => "Sherif Ahmeti",
                "translator" => "Sherif Ahmeti"
            ],
            [
                "id" => "ber.mensur",
                "language" => "Amazigh",
                "name" => "At Mensur",
                "translator" => "Ramdane At Mansour"
            ],
            [
                "id" => "ar.jalalayn",
                "language" => "Arabic",
                "name" => "تفسير الجلالين",
                "translator" => "Jalal ad-Din al-Mahalli and Jalal ad-Din as-Suyuti"
            ],
            [
                "id" => "ar.muyassar",
                "language" => "Arabic",
                "name" => "تفسير المیسر",
                "translator" => "King Fahad Quran Complex"
            ],
            [
                "id" => "am.sadiq",
                "language" => "Amharic",
                "name" => "ሳዲቅ & ሳኒ ሐቢብ",
                "translator" => "Muhammed Sadiq and Muhammed Sani Habib"
            ],
            [
                "id" => "az.mammadaliyev",
                "language" => "Azerbaijani",
                "name" => "Məmmədəliyev & Bünyadov",
                "translator" => "Vasim Mammadaliyev and Ziya Bunyadov"
            ],
            [
                "id" => "az.musayev",
                "language" => "Azerbaijani",
                "name" => "Musayev",
                "translator" => "Alikhan Musayev"
            ],
            [
                "id" => "bn.hoque",
                "language" => "Bengali",
                "name" => "জহুরুল হক",
                "translator" => "Zohurul Hoque"
            ],
            [
                "id" => "bn.bengali",
                "language" => "Bengali",
                "name" => "মুহিউদ্দীন খান",
                "translator" => "Muhiuddin Khan"
            ],
            [
                "id" => "bs.korkut",
                "language" => "Bosnian",
                "name" => "Korkut",
                "translator" => "Besim Korkut"
            ],
            [
                "id" => "bs.mlivo",
                "language" => "Bosnian",
                "name" => "Mlivo",
                "translator" => "Mustafa Mlivo"
            ],
            [
                "id" => "bg.theophanov",
                "language" => "Bulgarian",
                "name" => "Теофанов",
                "translator" => "Tzvetan Theophanov"
            ],
            [
                "id" => "zh.jian",
                "language" => "Chinese",
                "name" => "Ma Jian",
                "translator" => "Ma Jian"
            ],
            [
                "id" => "zh.majian",
                "language" => "Chinese",
                "name" => "Ma Jian (Traditional)",
                "translator" => "Ma Jian"
            ],
            [
                "id" => "cs.hrbek",
                "language" => "Czech",
                "name" => "Hrbek",
                "translator" => "Preklad I. Hrbek"
            ],
            [
                "id" => "cs.nykl",
                "language" => "Czech",
                "name" => "Nykl",
                "translator" => "A. R. Nykl"
            ],
            [
                "id" => "dv.divehi",
                "language" => "Divehi",
                "name" => "ދިވެހި",
                "translator" => "Office of the President of Maldives"
            ],
            [
                "id" => "nl.keyzer",
                "language" => "Dutch",
                "name" => "Keyzer",
                "translator" => "Salomo Keyzer"
            ],
            [
                "id" => "nl.leemhuis",
                "language" => "Dutch",
                "name" => "Leemhuis",
                "translator" => "Fred Leemhuis"
            ],
            [
                "id" => "nl.siregar",
                "language" => "Dutch",
                "name" => "Siregar",
                "translator" => "Sofian S. Siregar"
            ],
            [
                "id" => "en.ahmedali",
                "language" => "English",
                "name" => "Ahmed Ali",
                "translator" => "Ahmed Ali"
            ],
            [
                "id" => "en.ahmedraza",
                "language" => "English",
                "name" => "Ahmed Raza Khan",
                "translator" => "Ahmed Raza Khan"
            ],
            [
                "id" => "en.arberry",
                "language" => "English",
                "name" => "Arberry",
                "translator" => "A. J. Arberry"
            ],
            [
                "id" => "en.daryabadi",
                "language" => "English",
                "name" => "Daryabadi",
                "translator" => "Abdul Majid Daryabadi"
            ],
            [
                "id" => "en.hilali",
                "language" => "English",
                "name" => "Hilali & Khan",
                "translator" => "Muhammad Taqi-ud-Din al-Hilali and Muhammad Muhsin Khan"
            ],
            [
                "id" => "en.itani",
                "language" => "English",
                "name" => "Itani",
                "translator" => "Talal Itani"
            ],
            [
                "id" => "en.maududi",
                "language" => "English",
                "name" => "Maududi",
                "translator" => "Abul Ala Maududi"
            ],
            [
                "id" => "en.mubarakpuri",
                "language" => "English",
                "name" => "Mubarakpuri",
                "translator" => "Safi-ur-Rahman al-Mubarakpuri"
            ],
            [
                "id" => "en.pickthall",
                "language" => "English",
                "name" => "Pickthall",
                "translator" => "Mohammed Marmaduke William Pickthall"
            ],
            [
                "id" => "en.qarai",
                "language" => "English",
                "name" => "Qarai",
                "translator" => "Ali Quli Qarai"
            ],
            [
                "id" => "en.qaribullah",
                "language" => "English",
                "name" => "Qaribullah & Darwish",
                "translator" => "Hasan al-Fatih Qaribullah and Ahmad Darwish"
            ],
            [
                "id" => "en.sahih",
                "language" => "English",
                "name" => "Saheeh International",
                "translator" => "Saheeh International"
            ],
            [
                "id" => "en.sarwar",
                "language" => "English",
                "name" => "Sarwar",
                "translator" => "Muhammad Sarwar"
            ],
            [
                "id" => "en.shakir",
                "language" => "English",
                "name" => "Shakir",
                "translator" => "Mohammad Habib Shakir"
            ],
            [
                "id" => "en.transliteration",
                "language" => "English",
                "name" => "Transliteration",
                "translator" => "English Transliteration"
            ],
            [
                "id" => "en.wahiduddin",
                "language" => "English",
                "name" => "Wahiduddin Khan",
                "translator" => "Wahiduddin Khan"
            ],
            [
                "id" => "en.yusufali",
                "language" => "English",
                "name" => "Yusuf Ali",
                "translator" => "Abdullah Yusuf Ali"
            ],
            [
                "id" => "fr.hamidullah",
                "language" => "French",
                "name" => "Hamidullah",
                "translator" => "Muhammad Hamidullah"
            ],
            [
                "id" => "de.aburida",
                "language" => "German",
                "name" => "Abu Rida",
                "translator" => "Abu Rida Muhammad ibn Ahmad ibn Rassoul"
            ],
            [
                "id" => "de.bubenheim",
                "language" => "German",
                "name" => "Bubenheim & Elyas",
                "translator" => "A. S. F. Bubenheim and N. Elyas"
            ],
            [
                "id" => "de.khoury",
                "language" => "German",
                "name" => "Khoury",
                "translator" => "Adel Theodor Khoury"
            ],
            [
                "id" => "de.zaidan",
                "language" => "German",
                "name" => "Zaidan",
                "translator" => "Amir Zaidan"
            ],
            [
                "id" => "ha.gumi",
                "language" => "Hausa",
                "name" => "Gumi",
                "translator" => "Abubakar Mahmoud Gumi"
            ],
            [
                "id" => "hi.farooq",
                "language" => "Hindi",
                "name" => "फ़ारूक़ ख़ान & अहमद",
                "translator" => "Muhammad Farooq Khan and Muhammad Ahmed"
            ],
            [
                "id" => "hi.hindi",
                "language" => "Hindi",
                "name" => "फ़ारूक़ ख़ान & नदवी",
                "translator" => "Suhel Farooq Khan and Saifur Rahman Nadwi"
            ],
            [
                "id" => "id.indonesian",
                "language" => "Indonesian",
                "name" => "Bahasa Indonesia",
                "translator" => "Indonesian Ministry of Religious Affairs"
            ],
            [
                "id" => "id.muntakhab",
                "language" => "Indonesian",
                "name" => "Quraish Shihab",
                "translator" => "Muhammad Quraish Shihab et al."
            ],
            [
                "id" => "id.jalalayn",
                "language" => "Indonesian",
                "name" => "Tafsir Jalalayn",
                "translator" => "Jalal ad-Din al-Mahalli and Jalal ad-Din as-Suyuti"
            ],
            [
                "id" => "it.piccardo",
                "language" => "Italian",
                "name" => "Piccardo",
                "translator" => "Hamza Roberto Piccardo"
            ],
            [
                "id" => "ja.japanese",
                "language" => "Japanese",
                "name" => "Japanese",
                "translator" => "Unknown"
            ],
            [
                "id" => "ko.korean",
                "language" => "Korean",
                "name" => "Korean",
                "translator" => "Unknown"
            ],
            [
                "id" => "ku.asan",
                "language" => "Kurdish",
                "name" => "ته‌فسیری ئاسان",
                "translator" => "Burhan Muhammad-Amin"
            ],
            [
                "id" => "ms.basmeih",
                "language" => "Malay",
                "name" => "Basmeih",
                "translator" => "Abdullah Muhammad Basmeih"
            ],
            [
                "id" => "ml.abdulhameed",
                "language" => "Malayalam",
                "name" => "അബ്ദുല്‍ ഹമീദ് & പറപ്പൂര്‍",
                "translator" => "Cheriyamundam Abdul Hameed and Kunhi Mohammed Parappoor"
            ],
            [
                "id" => "ml.karakunnu",
                "language" => "Malayalam",
                "name" => "കാരകുന്ന് & എളയാവൂര്",
                "translator" => "Muhammad Karakunnu and Vanidas Elayavoor"
            ],
            [
                "id" => "no.berg",
                "language" => "Norwegian",
                "name" => "Einar Berg",
                "translator" => "Einar Berg"
            ],
            [
                "id" => "ps.abdulwali",
                "language" => "Pashto",
                "name" => "عبدالولي",
                "translator" => "Abdulwali Khan"
            ],
            [
                "id" => "fa.ansarian",
                "language" => "Persian",
                "name" => "انصاریان",
                "translator" => "Hussain Ansarian"
            ],
            [
                "id" => "fa.ayati",
                "language" => "Persian",
                "name" => "آیتی",
                "translator" => "AbdolMohammad Ayati"
            ],
            [
                "id" => "fa.bahrampour",
                "language" => "Persian",
                "name" => "بهرام پور",
                "translator" => "Abolfazl Bahrampour"
            ],
            [
                "id" => "fa.gharaati",
                "language" => "Persian",
                "name" => "قرائتی",
                "translator" => "Mohsen Gharaati"
            ],
            [
                "id" => "fa.ghomshei",
                "language" => "Persian",
                "name" => "الهی قمشه‌ای",
                "translator" => "Mahdi Elahi Ghomshei"
            ],
            [
                "id" => "fa.khorramdel",
                "language" => "Persian",
                "name" => "خرمدل",
                "translator" => "Mostafa Khorramdel"
            ],
            [
                "id" => "fa.khorramshahi",
                "language" => "Persian",
                "name" => "خرمشاهی",
                "translator" => "Baha'oddin Khorramshahi"
            ],
            [
                "id" => "fa.sadeqi",
                "language" => "Persian",
                "name" => "صادقی تهرانی",
                "translator" => "Mohammad Sadeqi Tehrani"
            ],
            [
                "id" => "fa.fooladvand",
                "language" => "Persian",
                "name" => "فولادوند",
                "translator" => "Mohammad Mahdi Fooladvand"
            ],
            [
                "id" => "fa.mojtabavi",
                "language" => "Persian",
                "name" => "مجتبوی",
                "translator" => "Sayyed Jalaloddin Mojtabavi"
            ],
            [
                "id" => "fa.moezzi",
                "language" => "Persian",
                "name" => "معزی",
                "translator" => "Mohammad Kazem Moezzi"
            ],
            [
                "id" => "fa.makarem",
                "language" => "Persian",
                "name" => "مکارم شیرازی",
                "translator" => "Naser Makarem Shirazi"
            ],
            [
                "id" => "pl.bielawskiego",
                "language" => "Polish",
                "name" => "Bielawskiego",
                "translator" => "Józefa Bielawskiego"
            ],
            [
                "id" => "pt.elhayek",
                "language" => "Portuguese",
                "name" => "El-Hayek",
                "translator" => "Samir El-Hayek"
            ],
            [
                "id" => "ro.grigore",
                "language" => "Romanian",
                "name" => "Grigore",
                "translator" => "George Grigore"
            ],
            [
                "id" => "ru.abuadel",
                "language" => "Russian",
                "name" => "Абу Адель",
                "translator" => "Abu Adel"
            ],
            [
                "id" => "ru.muntahab",
                "language" => "Russian",
                "name" => "Аль-Мунтахаб",
                "translator" => "Ministry of Awqaf, Egypt"
            ],
            [
                "id" => "ru.krachkovsky",
                "language" => "Russian",
                "name" => "Крачковский",
                "translator" => "Ignaty Yulianovich Krachkovsky"
            ],
            [
                "id" => "ru.kuliev",
                "language" => "Russian",
                "name" => "Кулиев",
                "translator" => "Elmir Kuliev"
            ],
            [
                "id" => "ru.kuliev-alsaadi",
                "language" => "Russian",
                "name" => "Кулиев + ас-Саади",
                "translator" => "Elmir Kuliev (with Abd ar-Rahman as-Saadi's commentaries)"
            ],
            [
                "id" => "ru.osmanov",
                "language" => "Russian",
                "name" => "Османов",
                "translator" => "Magomed-Nuri Osmanovich Osmanov"
            ],
            [
                "id" => "ru.porokhova",
                "language" => "Russian",
                "name" => "Порохова",
                "translator" => "V. Porokhova"
            ],
            [
                "id" => "ru.sablukov",
                "language" => "Russian",
                "name" => "Саблуков",
                "translator" => "Gordy Semyonovich Sablukov"
            ],
            [
                "id" => "sd.amroti",
                "language" => "Sindhi",
                "name" => "امروٽي",
                "translator" => "Taj Mehmood Amroti"
            ],
            [
                "id" => "so.abduh",
                "language" => "Somali",
                "name" => "Abduh",
                "translator" => "Mahmud Muhammad Abduh"
            ],
            [
                "id" => "es.bornez",
                "language" => "Spanish",
                "name" => "Bornez",
                "translator" => "Raúl González Bórnez"
            ],
            [
                "id" => "es.cortes",
                "language" => "Spanish",
                "name" => "Cortes",
                "translator" => "Julio Cortes"
            ],
            [
                "id" => "es.garcia",
                "language" => "Spanish",
                "name" => "Garcia",
                "translator" => "Muhammad Isa García"
            ],
            [
                "id" => "sw.barwani",
                "language" => "Swahili",
                "name" => "Al-Barwani",
                "translator" => "Ali Muhsin Al-Barwani"
            ],
            [
                "id" => "sv.bernstrom",
                "language" => "Swedish",
                "name" => "Bernström",
                "translator" => "Knut Bernström"
            ],
            [
                "id" => "tg.ayati",
                "language" => "Tajik",
                "name" => "Оятӣ",
                "translator" => "AbdolMohammad Ayati"
            ],
            [
                "id" => "ta.tamil",
                "language" => "Tamil",
                "name" => "ஜான் டிரஸ்ட்",
                "translator" => "Jan Turst Foundation"
            ],
            [
                "id" => "tt.nugman",
                "language" => "Tatar",
                "name" => "Yakub Ibn Nugman",
                "translator" => "Yakub Ibn Nugman"
            ],
            [
                "id" => "th.thai",
                "language" => "Thai",
                "name" => "ภาษาไทย",
                "translator" => "King Fahad Quran Complex"
            ],
            [
                "id" => "tr.golpinarli",
                "language" => "Turkish",
                "name" => "Abdulbakî Gölpınarlı",
                "translator" => "Abdulbaki Golpinarli"
            ],
            [
                "id" => "tr.bulac",
                "language" => "Turkish",
                "name" => "Alİ Bulaç",
                "translator" => "Alİ Bulaç"
            ],
            [
                "id" => "tr.transliteration",
                "language" => "Turkish",
                "name" => "Çeviriyazı",
                "translator" => "Muhammet Abay"
            ],
            [
                "id" => "tr.diyanet",
                "language" => "Turkish",
                "name" => "Diyanet İşleri",
                "translator" => "Diyanet Isleri"
            ],
            [
                "id" => "tr.vakfi",
                "language" => "Turkish",
                "name" => "Diyanet Vakfı",
                "translator" => "Diyanet Vakfi"
            ],
            [
                "id" => "tr.yuksel",
                "language" => "Turkish",
                "name" => "Edip Yüksel",
                "translator" => "Edip Yüksel"
            ],
            [
                "id" => "tr.yazir",
                "language" => "Turkish",
                "name" => "Elmalılı Hamdi Yazır",
                "translator" => "Elmalili Hamdi Yazir"
            ],
            [
                "id" => "tr.ozturk",
                "language" => "Turkish",
                "name" => "Öztürk",
                "translator" => "Yasar Nuri Ozturk"
            ],
            [
                "id" => "tr.yildirim",
                "language" => "Turkish",
                "name" => "Suat Yıldırım",
                "translator" => "Suat Yildirim"
            ],
            [
                "id" => "tr.ates",
                "language" => "Turkish",
                "name" => "Süleyman Ateş",
                "translator" => "Suleyman Ates"
            ],
            [
                "id" => "ur.maududi",
                "language" => "Urdu",
                "name" => "ابوالاعلی مودودی",
                "translator" => "Abul A'ala Maududi"
            ],
            [
                "id" => "ur.kanzuliman",
                "language" => "Urdu",
                "name" => "احمد رضا خان",
                "translator" => "Ahmed Raza Khan"
            ],
            [
                "id" => "ur.ahmedali",
                "language" => "Urdu",
                "name" => "احمد علی",
                "translator" => "Ahmed Ali"
            ],
            [
                "id" => "ur.jalandhry",
                "language" => "Urdu",
                "name" => "جالندہری",
                "translator" => "Fateh Muhammad Jalandhry"
            ],
            [
                "id" => "ur.qadri",
                "language" => "Urdu",
                "name" => "طاہر القادری",
                "translator" => "Tahir ul Qadri"
            ],
            [
                "id" => "ur.jawadi",
                "language" => "Urdu",
                "name" => "علامہ جوادی",
                "translator" => "Syed Zeeshan Haider Jawadi"
            ],
            [
                "id" => "ur.junagarhi",
                "language" => "Urdu",
                "name" => "محمد جوناگڑھی",
                "translator" => "Muhammad Junagarhi"
            ],
            [
                "id" => "ur.najafi",
                "language" => "Urdu",
                "name" => "محمد حسین نجفی",
                "translator" => "Muhammad Hussain Najafi"
            ],
            [
                "id" => "ug.saleh",
                "language" => "Uyghur",
                "name" => "محمد صالح",
                "translator" => "Muhammad Saleh"
            ],
            [
                "id" => "uz.sodik",
                "language" => "Uzbek",
                "name" => "Мухаммад Содик",
                "translator" => "Muhammad Sodik Muhammad Yusuf"
            ]
        ];

        if ($translation_id !== null) {
            foreach ($translations as $translation) {
                if ($translation_id == $translation['id']) {
                    return $translation;
                }
            }
        }

        return $translations;
    }
}
