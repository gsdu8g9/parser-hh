create table `vacancien_count` (
    `id` int(11) unsigned not null auto_increment,
    `search_string` varchar(100) not null default "",
    `create_date` datetime not null default now(),
    `find_result` varchar(100) not null default "",
    primary key(`id`)
) DEFAULT CHARSET=utf8