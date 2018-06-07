# Openclassrooms_PHP_POO_fight_game

### What is it ? 

Program written for the Openclassrooms course on the object oriented programmation with PHP. 
It requires a SQL file that you can create with this MySQL instruction : 

```sql
CREATE TABLE IF NOT EXISTS `characters` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `damages` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `strenght` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `experience` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
```

I made it with a MVC design pattern, it was not required but I wanted to practice. 

You just have to create a new character using the form, and then just click on the other character's names to fight them.

A normal hit is 5, and it will increase in the same time that you will gain experience and levels.
