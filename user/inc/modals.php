<?php
$subjects = $db->select_subjects();
$all_blog_for_help = $db->get_blog_by_category(1);
?>

<div class="uk-flex-top" id="modal-report" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title" data-translate-key="sendreport">Send Report</h2>
        <form class="uk-form-stacked" action="../function/reports.php" method="post" enctype="multipart/form-data"
            id="reportForm">
            <div class="uk-margin">
                <div class="uk-form-label" data-translate-key="subject">Subject</div>
                <div class="uk-form-controls">
                    <select name="sub" required class="js-select">
                        <option value="" data-translate-key="selectsubject">Select Subject</option>
                        <?php foreach ($subjects as $subject): ?>
                            <option value="<?php echo $subject['id']; ?>"><?php echo $subject['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-label" data-translate-key="details">Details</div>
                <div class="uk-form-controls">
                    <textarea data-translate-key="try_to_include_all_details" name="details" required class="uk-textarea"
                        >Try to include all details...</textarea>
                </div>
                <div class="uk-form-controls uk-margin-small-top">
                    <div data-uk-form-custom>
                        <input name="file" required type="file">
                        <button class="uk-button uk-button-default" type="button" tabindex="-1">
                            <i class="ico_attach-circle"></i><span data-translate-key="attachfile">Attach File</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-grid uk-flex-right fl-form-action" data-uk-grid>
                    <div><button class="uk-button uk-button-small uk-button-link" type="button" data-translate-key="cancel">Cancel</button></div>
                    <div><button class="uk-button uk-button-small uk-button-danger" type="submit" data-translate-key="submit">Submit</button></div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="uk-flex-top" id="modal-help" data-uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" data-uk-close></button>
        <h2 class="uk-modal-title" data-translate-key="help">Help</h2>
        <div class="search">
            <div class="search__input">
                <i class="ico_search"></i>
                <input type="search" name="search" placeholder="Search">

            </div>
        </div>
        <div class="uk-margin-small-left uk-margin-small-bottom uk-margin-medium-top">
            <h4 data-translate-key="popularqa">Popular Q&A</h4>
            <ul id="in_load">
                <?php foreach ($all_blog_for_help as $blog): ?>
                    <li><a href="blog.php?id=<?php echo $blog['id']; ?>"><?php echo $blog['address']; ?></a></li>
                <?php endforeach; ?>
            </ul>
            <ul>
                <li><a href="news.php" data-translate-key="browse_all_articles">browse all articles</a></li>
            </ul>
        </div>
    </div>
</div>


<script>
    // make search in help modal work 
    $(document).ready(function () {
        $('input[name="search"]').on('keyup', function () {
            var search = $(this).val();
            $.ajax({
                url: '../function/search_help.php',
                method: 'post',
                data: { search: search },
                success: function (data) {
                    $('#in_load').html(data);
                }
            });
        });
    });

</script>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        const translations = {
            arabic: {
                welcome: 'مرحبا',
                select_language: 'اختر اللغة',
                arabic :  'العربية',
                english : 'الإنجليزية',
                german : 'الألمانية',
                china : 'الصينية',
                french : 'الفرنسية',
                india : 'الهندية',
                myaccount : 'حسابي',
                changepassword : 'تغيير كلمة المرور',
                logout : 'تسجيل الخروج',
                home : 'الصفحة الرئيسية',
                news : 'الأخبار',
                wallet : 'المحفظة',
                streams : 'البثوث',
                support : 'الدعم',
                report : 'الإبلاغ',
                help : 'المساعدة',
                main : 'الرئيسية',
                sendreport : 'إرسال تقرير',
                subject : 'الموضوع',
                selectsubject : 'اختر الموضوع',
                details : 'التفاصيل',
                try_to_include_all_details : 'حاول تضمين جميع التفاصيل...',
                attachfile : 'إرفاق ملف',
                cancel : 'إلغاء',
                submit : 'إرسال',
                popularqa : 'الأسئلة والأجوبة الشائعة',
                browse_all_articles : 'تصفح جميع المقالات',
                noblogsfound : 'لم يتم العثور على مدونات.',
                updateaccount : 'تحديث الحساب',
                image : 'صورة',
                username : 'اسم المستخدم',
                nickname : 'اللقب',
                email : 'البريد الإلكتروني',
                update : 'تحديث',
                updatepassword : 'تحديث كلمة المرور',
                currentpassword : 'كلمة المرور الحالية',
                newpassword : 'كلمة المرور الجديدة',
                change : 'تغيير',

            },
            english: {
                welcome: 'Welcome',
                select_language: 'Select Language',
                arabic :  'Arabic',
                english : 'English',
                german : 'German',
                china : 'China',
                french : 'French',
                india : 'India',
                myaccount : 'My account',
                changepassword : 'Change Password',
                logout : 'Log Out',
                home : 'Home',
                news : 'News',
                wallet : 'Wallet',
                streams : 'Streams',
                support : 'Support',
                report : 'Report',
                help : 'Help',
                main : 'Main',
                sendreport : 'Send Report',
                subject : 'Subject',
                selectsubject : 'Select Subject',
                details : 'Details',
                try_to_include_all_details : 'Try to include all details...',
                attachfile : 'Attach File',
                cancel : 'Cancel',
                submit : 'Submit',
                popularqa : 'Popular Q&A',
                browse_all_articles : 'Browse all articles',
                noblogsfound : 'No blogs found.',
                updateaccount : 'Update Account',
                image : 'Image',
                username : 'User Name',
                nickname : 'Nick Name',
                email : 'Email',
                update : 'Update',  
                updatepassword : 'Update Password',
                currentpassword : 'Current Password',
                newpassword : 'New Password',
                change : 'Change',

                
                
            },
            german: {
                welcome: 'Willkommen',
                select_language: 'Sprache auswählen',
                arabic : 'Arabisch',
                english : 'Englisch',
                german : 'Deutsch',
                china : 'Chinesisch',
                french : 'Französisch',
                india : 'Indisch',
                myaccount : 'Mein Konto',
                changepassword : 'Pass ändern',
                logout : 'Ausloggen',
                home : 'Zuhause',
                news : 'Nachrichten',
                wallet : 'Brieftasche',
                streams : 'Ströme',
                support : 'Unterstützung',
                report : 'Bericht',
                help : 'Hilfe',
                main : 'Haupt',
                sendreport : 'Bericht senden',
                subject : 'Gegenstand',
                selectsubject : 'Wählen Sie ein Thema',
                details : 'Einzelheiten',
                try_to_include_all_details : 'Versuchen Sie, alle Details einzubeziehen...',
                attachfile : 'Datei anhängen',
                cancel : 'Stornieren',
                submit : 'einreichen',
                popularqa : 'Beliebte Fragen und Antworten',
                browse_all_articles : 'Alle Artikel durchsuchen',
                noblogsfound : 'Keine Blogs gefunden.',
                updateaccount :  'Konto aktualisieren',
                image : 'Bild',
                username : 'Benutzername',
                nickname : 'Spitzname',
                email : 'Email',
                update : 'Aktualisieren',
                updatepassword : 'Passwort aktualisieren',
                currentpassword : 'Aktuelles Passwort',
                newpassword : 'Neues Passwort',
                change : 'Veränderung',

            },
            china: {
                welcome: '欢迎',
                select_language: '选择语言',
                arabic : '阿拉伯语',
                english : '英语',
                german : '德语',
                china : '中文',
                french : '法语',
                india : '印地语',
                myaccount : '我的帐户',
                changepassword : '更改密码',
                logout : '登出',
                home : '家',
                news : '新闻',
                wallet : '钱包',
                streams : '流',
                support : '支持',
                report : '报告',
                help : '帮助',
                main : '主要',
                sendreport : '发送报告',
                subject : '学科',
                selectsubject : '选择学科',
                details : '细节',
                try_to_include_all_details : '尽量包含所有细节...',
                attachfile : '附加文件',
                cancel : '取消',
                submit : '提交',
                popularqa : '热门问答',
                browse_all_articles : '浏览所有文章',
                noblogsfound : '未找到博客。',
                updateaccount : '更新帐户',
                image : '图片',
                username : '用户名',
                nickname : '昵称',
                email : '电子邮件',
                update : '更新',
                updatepassword : '更新密码',
                currentpassword : '当前密码',
                newpassword : '新密码',
                change : '更改',


            },
            french: {
                welcome: 'Bienvenue',
                select_language: 'Choisir la langue',
                arabic : 'Arabe',
                english : 'Anglais',
                german : 'Allemand',
                china : 'Chinois',
                french : 'Français',
                india : 'Indien',
                myaccount : 'Mon compte',
                changepassword : 'Changer le mot de passe',
                logout : 'Se déconnecter',
                home : 'Accueil',
                news : 'Actualités',
                wallet : 'Portefeuille',
                streams : 'Ruisseaux',
                support : 'Soutien',
                report : 'Rapport',
                help : 'Aide',
                main : 'Principal',
                sendreport : 'Envoyer un rapport',
                subject : 'Sujet',
                selectsubject : 'Sélectionnez le sujet',
                details : 'Détails',
                try_to_include_all_details : 'Essayez d\'inclure tous les détails...',
                attachfile : 'Attacher un fichier',
                cancel : 'Annuler',
                submit : 'Soumettre',
                popularqa : 'Questions et réponses populaires',
                browse_all_articles : 'Parcourir tous les articles',
                noblogsfound : 'Aucun blog trouvé.',
                updateaccount : 'Mettre à jour le compte',
                image : 'Image',
                username : 'Nom d\'utilisateur',
                nickname : 'Surnom',
                email : 'Email',
                update : 'Mettre à jour',
                updatepassword : 'Mettre à jour le mot de passe',
                currentpassword : 'Mot de passe actuel',
                newpassword : 'Nouveau mot de passe',
                change : 'Changement',
                

            },
            india: {
                welcome: 'स्वागत है',
                select_language: 'भाषा चुनें',
                arabic : 'अरबी',
                english : 'अंग्रेज़ी',
                german : 'जर्मन',
                china : 'चीनी',
                french : 'फ्रांसीसी',
                india : 'भारतीय',
                myaccount : 'मेरा खाता',
                changepassword : 'पासवर्ड बदलें',
                logout : 'लॉग आउट',
                home : 'घर',
                news : 'समाचार',
                wallet : 'बटुआ',
                streams : 'धाराएँ',
                support : 'समर्थन',
                report : 'रिपोर्ट',
                help : 'मदद',
                main : 'मुख्य',
                sendreport : 'रिपोर्ट भेजें',
                subject : 'विषय',
                selectsubject : 'विषय चुनें',
                details : 'विवरण',
                try_to_include_all_details : 'सभी विवरण शामिल करने का प्रयास करें...',
                attachfile : 'फ़ाइल जोड़ें',
                cancel : 'रद्द करें',
                submit : 'प्रस्तुत',
                popularqa : 'लोकप्रिय प्रश्न और उत्तर',
                browse_all_articles : 'सभी लेख ब्राउज़ करें',
                noblogsfound : 'कोई ब्लॉग नहीं मिला।',
                updateaccount : 'खात अपडेट करें',
                image : 'छवि',
                username : 'उपयोगकर्ता नाम',
                nickname : 'उपनाम',
                email : 'ईमेल',
                update : 'अपडेट',
                updatepassword : 'पासवर्ड अपडेट करें',
                currentpassword : 'वर्तमान पासवर्ड',
                newpassword : 'नया पासवर्ड',
                change : 'परिवर्तन',

            },
        };

        function translateContent(language) {
            const elementsToTranslate = document.querySelectorAll('[data-translate-key]');
            elementsToTranslate.forEach((element) => {
                const key = element.getAttribute('data-translate-key');
                if (translations[language] && translations[language][key]) {
                    element.innerText = translations[language][key];
                } else {
                    console.warn(`Translation for key "${key}" not found in "${language}" language.`);
                }
            });
        }

        const currentLanguageElement = document.querySelector('.uk-subnav-lang .lan');
        const languageDropdownItems = document.querySelectorAll('.uk-dropdown-nav .lan');

        function updateLanguageUI(language) {
            const selectedFlag = document.querySelector(`[data-lang="${language}"] img`);
            const selectedText = document.querySelector(`[data-lang="${language}"]`);

            if (currentLanguageElement && selectedFlag && selectedText) {
                currentLanguageElement.querySelector('img').src = selectedFlag.src;
                currentLanguageElement.querySelector('span').innerText = selectedText.textContent.trim();
            } else {
                console.warn(`Unable to find UI elements for language "${language}".`);
            }
        }

        const savedLanguage = localStorage.getItem('selectedLanguage') || 'english';
        translateContent(savedLanguage);
        updateLanguageUI(savedLanguage);

        languageDropdownItems.forEach((item) => {
            item.addEventListener('click', (event) => {
                event.preventDefault();
                const selectedLanguage = item.getAttribute('data-lang');
                if (translations[selectedLanguage]) {
                    localStorage.setItem('selectedLanguage', selectedLanguage);
                    translateContent(selectedLanguage);
                    updateLanguageUI(selectedLanguage);
                } else {
                    console.warn(`Translations for language "${selectedLanguage}" are not available.`);
                }
            });
        });
    });


</script>