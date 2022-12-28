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

        //courses table
        $query = "

            CREATE TABLE `courses` (
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