<?php
/**
 * database class
 */
class Database
{
	private function connect()
    {
        $str = DBDRIVER.":hostname=".DBHOST.";dbname=".DBNAME;
        return new PDO($str,DBUSER,DBPASS);
    }

    public function query($query, $data = [], $type = 'object')
    {
        $con = $this->connect();

        $stm = $con->prepare($query);
        if($stm)
        {
            $check = $stm->execute($data);
            if($check)
            {

                if($type == 'object')
                {
                    $type = PDO::FETCH_OBJ; 
                }else{
                    $type = PDO::FETCH_ASSOC;
                }

                $result = $stm->fetchAll($type);

                if(is_array($result) && count($result) > 0)
                {
                    return $result;
                }
            }
        }
        return false;
    }

    public function create_tables()
    {
        //users table
        $query = "

        CREATE TABLE IF NOT EXISTS `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(100) NOT NULL,
            `firstname` varchar(30) NOT NULL,
            `lastname` varchar(30) NOT NULL,
            `password` varchar(255) NOT NULL,
            `role` varchar(20) NOT NULL,
            `date` date DEFAULT NULL,
            `about` varchar(2048) DEFAULT NULL,
            `company` varchar(100) DEFAULT NULL,
            `job` varchar(100) DEFAULT NULL,
            `country` varchar(100) DEFAULT NULL,
            `address` varchar(1024) DEFAULT NULL,
            `phone` varchar(11) DEFAULT NULL,
            `slug` varchar(100) NOT NULL,
            `image` varchar(1024) NOT NULL,
            `vkontakte_link` varchar(1024) DEFAULT NULL,
            `telegram_link` varchar(1024) DEFAULT NULL,
            `headhunter_link` varchar(1024) DEFAULT NULL,
            `bigbluebutton_link` varchar(1024) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `email` (`email`),
            KEY `firstname` (`email`),
            KEY `lastname` (`email`),
            KEY `date` (`date`),
            KEY `slug` (`slug`)
           ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4
        ";

        $this->query($query);

         //prices table
         $query = "

         CREATE TABLE IF NOT EXISTS `prices` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(60) NOT NULL,
            `price` decimal(10,0) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `price` (`price`),
            KEY `disabled` (`disabled`),
            KEY `name` (`name`)
           ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4
         ";

         $this->query($query);

         // insert into prices table
         $query = "
            INSERT INTO `prices` (`id`, `name`, `price`, `disabled`) VALUES (1, 'Бесплатно', '0', 0);
         ";
         
         $this->query($query);

         //course_levels table
         $query = "

         CREATE TABLE IF NOT EXISTS `course_levels` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `level` varchar(30) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `disabled` (`disabled`)
            ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4
         ";

         $this->query($query);

         // insert into course_levels table
         $query = "
         INSERT INTO `course_levels` (`id`, `level`, `disabled`) VALUES
            (1, 'Начальный уровень', 0),
            (2, 'Средний уровень', 0),
            (3, 'Профессиональный уровень', 0),
            (4, 'Все уровни', 0);
         ";
         
         $this->query($query);

         $this->query($query);

         //currencies table
         $query = "

         CREATE TABLE IF NOT EXISTS `currencies` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `currency` varchar(20) NOT NULL,
            `symbol` varchar(4) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `disabled` (`disabled`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4
         ";

         $this->query($query);

         // insert into currencies table
         $query = "
         INSERT INTO `currencies` (`id`, `currency`, `symbol`, `disabled`) VALUES (1, 'US Dollar', '$', 0);
         ";
         
         $this->query($query);

         //languages table
         $query = "

         CREATE TABLE IF NOT EXISTS `languages` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `symbol` varchar(10) NOT NULL,
            `language` varchar(30) NOT NULL,
            `disabled` tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`),
            KEY `disabled` (`disabled`)
            ) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4
         ";

         $this->query($query);

         // insert into languages table
         $query = "
         INSERT INTO `languages` (`id`, `symbol`, `language`, `disabled`) VALUES
            (1, 'af_ZA', 'Afrikaans', 0),
            (2, 'sq_AL', 'Shqip', 0),
            (3, 'ar_AR', 'العربية', 0),
            (4, 'hy_AM', 'Հայերեն', 0),
            (5, 'ay_BO', 'Aymar aru', 0),
            (6, 'az_AZ', 'Azərbaycan dili', 0),
            (7, 'eu_ES', 'Euskara', 0),
            (8, 'bn_IN', 'Bangla', 0),
            (9, 'bs_BA', 'Bosanski', 0),
            (10, 'bg_BG', 'Български', 0),
            (11, 'my_MM', 'မြန်မာဘာသာ', 0),
            (12, 'ca_ES', 'Català', 0),
            (13, 'ck_US', 'Cherokee', 0),
            (14, 'hr_HR', 'Hrvatski', 0),
            (15, 'cs_CZ', 'Čeština', 0),
            (16, 'da_DK', 'Dansk', 0),
            (17, 'nl_NL', 'Nederlands', 0),
            (18, 'nl_BE', 'Nederlands (België)', 0),
            (19, 'en_IN', 'English (India)', 0),
            (20, 'en_GB', 'English (UK)', 0),
            (21, 'en_US', 'English (US)', 0),
            (22, 'et_EE', 'Eesti', 0),
            (23, 'fo_FO', 'Føroyskt', 0),
            (24, 'tl_PH', 'Filipino', 0),
            (25, 'fi_FI', 'Suomi', 0),
            (26, 'fr_CA', 'Français (Canada)', 0),
            (27, 'fr_FR', 'Français (France)', 0),
            (28, 'fy_NL', 'Frysk', 0),
            (29, 'gl_ES', 'Galego', 0),
            (30, 'ka_GE', 'ქართული', 0),
            (31, 'de_DE', 'Deutsch', 0),
            (32, 'el_GR', 'Ελληνικά', 0),
            (33, 'gn_PY', 'Avañe\'ẽ', 0),
            (34, 'gu_IN', 'ગુજરાતી', 0),
            (35, 'ht_HT', 'Ayisyen', 0),
            (36, 'he_IL', 'עברית', 0),
            (37, 'hi_IN', 'हिन्दी', 0),
            (38, 'hu_HU', 'Magyar', 0),
            (39, 'is_IS', 'Íslenska', 0),
            (40, 'id_ID', 'Bahasa Indonesia', 0),
            (41, 'ga_IE', 'Gaeilge', 0),
            (42, 'it_IT', 'Italiano', 0),
            (43, 'ja_JP', '日本語', 0),
            (44, 'jv_ID', 'Basa Jawa', 0),
            (45, 'kn_IN', 'Kannaḍa', 0),
            (46, 'kk_KZ', 'Қазақша', 0),
            (47, 'km_KH', 'Khmer', 0),
            (48, 'ko_KR', '한국어', 0),
            (49, 'ku_TR', 'Kurdî', 0),
            (50, 'lv_LV', 'Latviešu', 0),
            (51, 'li_NL', 'Lèmbörgs', 0),
            (52, 'lt_LT', 'Lietuvių', 0),
            (53, 'mk_MK', 'Македонски', 0),
            (54, 'mg_MG', 'Malagasy', 0),
            (55, 'ms_MY', 'Bahasa Melayu', 0),
            (56, 'ml_IN', 'Malayāḷam', 0),
            (57, 'mt_MT', 'Malti', 0),
            (58, 'mr_IN', 'मराठी', 0),
            (59, 'mn_MN', 'Монгол', 0),
            (60, 'ne_NP', 'नेपाली', 0),
            (61, 'se_NO', 'Davvisámegiella', 0),
            (62, 'nb_NO', 'Norsk (bokmål)', 0),
            (63, 'nn_NO', 'Norsk (nynorsk)', 0),
            (64, 'ps_AF', 'پښتو', 0),
            (65, 'fa_IR', 'فارسی', 0),
            (66, 'pl_PL', 'Polski', 0),
            (67, 'pt_BR', 'Português (Brasil)', 0),
            (68, 'pt_PT', 'Português (Portugal)', 0),
            (69, 'pa_IN', 'ਪੰਜਾਬੀ', 0),
            (70, 'qu_PE', 'Qhichwa', 0),
            (71, 'ro_RO', 'Română', 0),
            (72, 'rm_CH', 'Rumantsch', 0),
            (73, 'ru_RU', 'Русский', 0),
            (74, 'sa_IN', 'संस्कृतम्', 0),
            (75, 'sr_RS', 'Српски', 0),
            (76, 'zh_CN', '中文(简体)', 0),
            (77, 'sk_SK', 'Slovenčina', 0),
            (78, 'sl_SI', 'Slovenščina', 0),
            (79, 'so_SO', 'Soomaaliga', 0),
            (80, 'es_LA', 'Español', 0),
            (81, 'es_CL', 'Español (Chile)', 0),
            (82, 'es_CO', 'Español (Colombia)', 0),
            (83, 'es_MX', 'Español (México)', 0),
            (84, 'es_ES', 'Español (España)', 0),
            (85, 'es_VE', 'Español (Venezuela)', 0),
            (86, 'sw_KE', 'Kiswahili', 0),
            (87, 'sv_SE', 'Svenska', 0),
            (88, 'sy_SY', 'Leššānā Suryāyā', 0),
            (89, 'tg_TJ', 'тоҷикӣ, تاجیکی, tojikī', 0),
            (90, 'ta_IN', 'தமிழ்', 0),
            (91, 'tt_RU', 'татарча / Tatarça / تاتارچا', 0),
            (92, 'te_IN', 'Telugu', 0),
            (93, 'th_TH', 'ภาษาไทย', 0),
            (94, 'zh_HK', '中文(香港)', 0),
            (95, 'zh_TW', '中文 (繁體)', 0),
            (96, 'tr_TR', 'Türkçe', 0),
            (97, 'uk_UA', 'Українська', 0),
            (98, 'ur_PK', 'اردو', 0),
            (99, 'uz_UZ', 'O\'zbek', 0),
            (100, 'vi_VN', 'Tiếng Việt', 0),
            (101, 'cy_GB', 'Cymraeg', 0),
            (102, 'xh_ZA', 'isiXhosa', 0),
            (103, 'yi_DE', 'ייִדיש', 0),
            (104, 'zu_ZA', 'isiZulu', 0);
         ";
         
         $this->query($query);

        //courses table
        $query = "

            CREATE TABLE IF NOT EXISTS `courses` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(100) NOT NULL,
            `description` text DEFAULT NULL,
            `user_id` int(11) NOT NULL,
            `category_id` int(11) NOT NULL,
            `sub_category_id` int(11) DEFAULT NULL,
            `level_id` int(11) DEFAULT NULL,
            `language_id` int(11) DEFAULT NULL,
            `price_id` int(11) DEFAULT NULL,
            `promo_link` varchar(1024) DEFAULT NULL,
            `course_image` varchar(1024) DEFAULT NULL,
            `course_promo_video` varchar(1024) DEFAULT NULL,
            `primary_subject` varchar(100) DEFAULT NULL,
            `date` datetime DEFAULT NULL,
            `tags` varchar(2048) DEFAULT NULL,
            `congratulations_message` varchar(2048) DEFAULT NULL,
            `welcome_message` varchar(2048) DEFAULT NULL,
            `approved` tinyint(1) NOT NULL DEFAULT 0,
            `published` tinyint(1) NOT NULL DEFAULT 0,
            `subtitle` varchar(100) DEFAULT NULL,
            `currency_id` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `title` (`title`),
            KEY `user_id` (`user_id`),
            KEY `category_id` (`category_id`),
            KEY `sub_category_id` (`sub_category_id`),
            KEY `level_id` (`level_id`),
            KEY `language_id` (`language_id`),
            KEY `price_id` (`price_id`),
            KEY `primary_subject` (`primary_subject`),
            KEY `date` (`date`),
            KEY `approved` (`approved`),
            KEY `published` (`published`)
            ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4
        ";

        $this->query($query);
    }
}