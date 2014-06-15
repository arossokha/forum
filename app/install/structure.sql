CREATE TABLE `Theme` (
 `themeId` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(500) NOT NULL,
 `lastMessageTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `viewsCount` int(11) NOT NULL DEFAULT '0',
 `messageCount` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`themeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8