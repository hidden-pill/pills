#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: questions
#------------------------------------------------------------

CREATE TABLE questions(
        id       Int NOT NULL ,
        question Varchar (255) NOT NULL
	,CONSTRAINT questions_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: tags
#------------------------------------------------------------

CREATE TABLE tags(
        id  Int NOT NULL ,
        tag Varchar (50) NOT NULL
	,CONSTRAINT tags_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: articleTypes
#------------------------------------------------------------

CREATE TABLE articleTypes(
        id          Int NOT NULL ,
        articleType Varchar (50) NOT NULL
	,CONSTRAINT articleTypes_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: nationalities
#------------------------------------------------------------

CREATE TABLE nationalities(
        id          Int NOT NULL ,
        nationality Varchar (50) NOT NULL
	,CONSTRAINT nationalities_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: countries
#------------------------------------------------------------

CREATE TABLE countries(
        id      Int NOT NULL ,
        country Varchar (50) NOT NULL
	,CONSTRAINT countries_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: genres
#------------------------------------------------------------

CREATE TABLE genres(
        id    Int NOT NULL ,
        genre Varchar (50) NOT NULL
	,CONSTRAINT genres_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: jobs
#------------------------------------------------------------

CREATE TABLE jobs(
        id  Int NOT NULL ,
        job Varchar (50) NOT NULL
	,CONSTRAINT jobs_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: artists
#------------------------------------------------------------

CREATE TABLE artists(
        id         Int NOT NULL ,
        name       Varchar (100) NOT NULL ,
        birthDate  Date NOT NULL ,
        deathDate  Date NOT NULL ,
        biography  Text NOT NULL ,
        validation Bool NOT NULL
	,CONSTRAINT artists_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ranks
#------------------------------------------------------------

CREATE TABLE ranks(
        id   Int NOT NULL ,
        rank Varchar (50) NOT NULL
	,CONSTRAINT ranks_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE `users`(
        `id`           Int NOT NULL ,
        `pseudo`       Varchar (24) NOT NULL ,
        `password`     Varchar (100) NOT NULL ,
        `email`        Varchar (255) NOT NULL ,
        `secretAnswer` Varchar (50) NOT NULL ,
        `newsletter`   Bool NOT NULL ,
        `birthDate`    Date NOT NULL ,
        `creationDate` Datetime NOT NULL ,
        `experience`   Int NOT NULL ,
        `id_questions` Int NOT NULL ,
        `id_ranks`     Int NOT NULL
	,CONSTRAINT `users_PK` PRIMARY KEY (id)

	,CONSTRAINT `users_questions_FK` FOREIGN KEY (`id_questions`) REFERENCES `questions`(`id`)
	,CONSTRAINT `users_ranks0_FK` FOREIGN KEY (`id_ranks`) REFERENCES `ranks`(`id`)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: proposals
#------------------------------------------------------------

CREATE TABLE proposals(
        id       Int NOT NULL ,
        proposal Text NOT NULL ,
        date     Date NOT NULL ,
        id_users Int NOT NULL
	,CONSTRAINT proposals_PK PRIMARY KEY (id)

	,CONSTRAINT proposals_users_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: levels
#------------------------------------------------------------

CREATE TABLE levels(
        id      Int NOT NULL ,
        level   Int NOT NULL ,
        levelxp Int NOT NULL ,
        color   Varchar (11) NOT NULL ,
        title   Varchar (100)
	,CONSTRAINT levels_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: distributors
#------------------------------------------------------------

CREATE TABLE distributors(
        id          Int NOT NULL ,
        distributor Varchar (50) NOT NULL
	,CONSTRAINT distributors_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: artworks
#------------------------------------------------------------

CREATE TABLE artworks(
        id              Int NOT NULL ,
        name            Varchar (100) NOT NULL ,
        releaseDate     Date NOT NULL ,
        synopsis        Text NOT NULL ,
        budget          Int NOT NULL ,
        validation      Bool NOT NULL ,
        id_articleTypes Int NOT NULL ,
        id_distributors Int NOT NULL
	,CONSTRAINT artworks_PK PRIMARY KEY (id)

	,CONSTRAINT artworks_articleTypes_FK FOREIGN KEY (id_articleTypes) REFERENCES articleTypes(id)
	,CONSTRAINT artworks_distributors0_FK FOREIGN KEY (id_distributors) REFERENCES distributors(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reviews
#------------------------------------------------------------

CREATE TABLE reviews(
        id          Int NOT NULL ,
        title       Varchar (255) NOT NULL ,
        review      Text NOT NULL ,
        date        Datetime NOT NULL ,
        id_users    Int NOT NULL ,
        id_artworks Int NOT NULL
	,CONSTRAINT reviews_PK PRIMARY KEY (id)

	,CONSTRAINT reviews_users_FK FOREIGN KEY (id_users) REFERENCES users(id)
	,CONSTRAINT reviews_artworks0_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        id           Int NOT NULL ,
        comment      Text NOT NULL ,
        date         Datetime NOT NULL ,
        commentsId   Int NOT NULL ,
        id_reviews   Int NOT NULL ,
        id_proposals Int NOT NULL ,
        id_artists   Int NOT NULL ,
        id_users     Int NOT NULL ,
        id_artworks  Int NOT NULL
	,CONSTRAINT comments_AK UNIQUE (commentsId)
	,CONSTRAINT comments_PK PRIMARY KEY (id)

	,CONSTRAINT comments_reviews_FK FOREIGN KEY (id_reviews) REFERENCES reviews(id)
	,CONSTRAINT comments_proposals0_FK FOREIGN KEY (id_proposals) REFERENCES proposals(id)
	,CONSTRAINT comments_artists1_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT comments_users2_FK FOREIGN KEY (id_users) REFERENCES users(id)
	,CONSTRAINT comments_artworks3_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: upvotes
#------------------------------------------------------------

CREATE TABLE upvotes(
        id           Int NOT NULL ,
        upvote       Bool NOT NULL ,
        id_proposals Int NOT NULL ,
        id_comments  Int NOT NULL ,
        id_reviews   Int NOT NULL ,
        id_users     Int NOT NULL
	,CONSTRAINT upvotes_PK PRIMARY KEY (id)

	,CONSTRAINT upvotes_proposals_FK FOREIGN KEY (id_proposals) REFERENCES proposals(id)
	,CONSTRAINT upvotes_comments0_FK FOREIGN KEY (id_comments) REFERENCES comments(id)
	,CONSTRAINT upvotes_reviews1_FK FOREIGN KEY (id_reviews) REFERENCES reviews(id)
	,CONSTRAINT upvotes_users2_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: scores
#------------------------------------------------------------

CREATE TABLE scores(
        id          Int NOT NULL ,
        score       Int NOT NULL ,
        id_artworks Int NOT NULL ,
        id_artists  Int NOT NULL ,
        id_users    Int
	,CONSTRAINT scores_PK PRIMARY KEY (id)

	,CONSTRAINT scores_artworks_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
	,CONSTRAINT scores_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT scores_users1_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: rewards
#------------------------------------------------------------

CREATE TABLE rewards(
        id     Int NOT NULL ,
        reward Int NOT NULL
	,CONSTRAINT rewards_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AANationalities
#------------------------------------------------------------

CREATE TABLE AANationalities(
        id               Int NOT NULL ,
        id_artists       Int NOT NULL ,
        id_artworks      Int NOT NULL ,
        id_nationalities Int NOT NULL
	,CONSTRAINT AANationalities_PK PRIMARY KEY (id)

	,CONSTRAINT AANationalities_artists_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT AANationalities_artworks0_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
	,CONSTRAINT AANationalities_nationalities1_FK FOREIGN KEY (id_nationalities) REFERENCES nationalities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AACountries
#------------------------------------------------------------

CREATE TABLE AACountries(
        id           Int NOT NULL ,
        id_artworks  Int NOT NULL ,
        id_artists   Int NOT NULL ,
        id_countries Int NOT NULL
	,CONSTRAINT AACountries_PK PRIMARY KEY (id)

	,CONSTRAINT AACountries_artworks_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
	,CONSTRAINT AACountries_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT AACountries_countries1_FK FOREIGN KEY (id_countries) REFERENCES countries(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: artistsJobs
#------------------------------------------------------------

CREATE TABLE artistsJobs(
        id         Int NOT NULL ,
        id_artists Int NOT NULL ,
        id_jobs    Int NOT NULL
	,CONSTRAINT artistsJobs_PK PRIMARY KEY (id)

	,CONSTRAINT artistsJobs_artists_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT artistsJobs_jobs0_FK FOREIGN KEY (id_jobs) REFERENCES jobs(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reviewsTags
#------------------------------------------------------------

CREATE TABLE reviewsTags(
        id         Int NOT NULL ,
        id_reviews Int NOT NULL ,
        id_tags    Int NOT NULL
	,CONSTRAINT reviewsTags_PK PRIMARY KEY (id)

	,CONSTRAINT reviewsTags_reviews_FK FOREIGN KEY (id_reviews) REFERENCES reviews(id)
	,CONSTRAINT reviewsTags_tags0_FK FOREIGN KEY (id_tags) REFERENCES tags(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: artworksGenres
#------------------------------------------------------------

CREATE TABLE artworksGenres(
        id          Int NOT NULL ,
        id_artworks Int NOT NULL ,
        id_genres   Int NOT NULL
	,CONSTRAINT artworksGenres_PK PRIMARY KEY (id)

	,CONSTRAINT artworksGenres_artworks_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
	,CONSTRAINT artworksGenres_genres0_FK FOREIGN KEY (id_genres) REFERENCES genres(id)
	,CONSTRAINT artworksGenres_genres_AK UNIQUE (id_genres)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: trailers
#------------------------------------------------------------

CREATE TABLE trailers(
        id          Int NOT NULL ,
        trailer     Varchar (100) NOT NULL ,
        id_artworks Int NOT NULL
	,CONSTRAINT trailers_PK PRIMARY KEY (id)

	,CONSTRAINT trailers_artworks_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: plateforms
#------------------------------------------------------------

CREATE TABLE plateforms(
        id        Int NOT NULL ,
        plateform Varchar (50) NOT NULL
	,CONSTRAINT plateforms_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: artworksPlateforms
#------------------------------------------------------------

CREATE TABLE artworksPlateforms(
        id            Int NOT NULL ,
        id_artworks   Int NOT NULL ,
        id_plateforms Int NOT NULL
	,CONSTRAINT artworksPlateforms_PK PRIMARY KEY (id)

	,CONSTRAINT artworksPlateforms_artworks_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
	,CONSTRAINT artworksPlateforms_plateforms0_FK FOREIGN KEY (id_plateforms) REFERENCES plateforms(id)
	,CONSTRAINT artworksPlateforms_plateforms_AK UNIQUE (id_plateforms)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reports
#------------------------------------------------------------

CREATE TABLE reports(
        id       Int NOT NULL ,
        report   Text NOT NULL ,
        id_users Int
	,CONSTRAINT reports_PK PRIMARY KEY (id)

	,CONSTRAINT reports_users_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AA
#------------------------------------------------------------

CREATE TABLE AA(
        id          Int NOT NULL ,
        id_artists  Int NOT NULL ,
        id_artworks Int NOT NULL
	,CONSTRAINT AA_PK PRIMARY KEY (id)

	,CONSTRAINT AA_artists_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT AA_artworks0_FK FOREIGN KEY (id_artworks) REFERENCES artworks(id)
)ENGINE=InnoDB;






#------------------------------------------------------------
# ALTER
#------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `users` ADD UNIQUE( `pseudo`, `email`);

ALTER TABLE `users` 
        CHANGE `creationDate` `creationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
        CHANGE `experience` `experience` INT(11) NOT NULL DEFAULT '0', 
        CHANGE `id_ranks` `id_ranks` INT(11) NOT NULL DEFAULT '1';

ALTER TABLE `artworks` 
        CHANGE `budget` `budget` INT(11) NULL DEFAULT NULL,
        CHANGE `validation` `validation` TINYINT(1) NOT NULL DEFAULT '0';

ALTER TABLE `reviews` CHANGE `date` `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;


ALTER TABLE `AA` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `AANationalities` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `AACountries` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `articleTypes` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artists` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artistsJobs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artworksGenres` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `comments` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `countries` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artworksPlateforms` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artworks` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `distributors` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `genres` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `jobs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `levels` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `nationalities` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `proposals` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `questions` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `ranks` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reports` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reviews` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reviewsTags` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rewards` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `scores` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tags` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `trailers` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `upvotes` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `plateforms` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `upvotes` 
        CHANGE `id_proposals` `id_proposals` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_comments` `id_comments` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_reviews` `id_reviews` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_users` `id_users` INT(11) NULL DEFAULT NULL;

ALTER TABLE `scores` 
        CHANGE `id_artworks` `id_artworks` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_artists` `id_artists` INT(11) NULL DEFAULT NULL;

ALTER TABLE `AANationalities` 
        CHANGE `id_artists` `id_artists` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_artworks` `id_artworks` INT(11) NULL DEFAULT NULL; 

ALTER TABLE `AACountries` 
        CHANGE `id_artworks` `id_artworks` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_artists` `id_artists` INT(11) NULL DEFAULT NULL; 

ALTER TABLE `reviewsTags` DROP FOREIGN KEY `reviewsTags_reviews_FK`; 
ALTER TABLE `reviewsTags` ADD CONSTRAINT `reviewsTags_reviews_FK` FOREIGN KEY (`id_reviews`) REFERENCES `reviews`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT; 

ALTER TABLE `artworks` CHANGE `id_distributors` `id_distributors` INT(11) NULL DEFAULT NULL;

ALTER TABLE `comments` CHANGE `date` `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `comments` 
        CHANGE `commentsId` `commentsId` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_reviews` `id_reviews` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_proposals` `id_proposals` INT(11) NULL DEFAULT NULL, 
        CHANGE `id_artists` `id_artists` INT(11) NULL DEFAULT NULL,
        CHANGE `id_artworks` `id_artworks` INT(11) NULL DEFAULT NULL;

ALTER TABLE `comments` DROP FOREIGN KEY `comments_artists1_FK`;
ALTER TABLE `comments` ADD  CONSTRAINT `comments_artists1_FK` FOREIGN KEY (`id_artists`) REFERENCES `artists`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comments` DROP FOREIGN KEY `comments_artworks3_FK`;
ALTER TABLE `comments` ADD  CONSTRAINT `comments_artworks3_FK` FOREIGN KEY (`id_artworks`) REFERENCES `artworks`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comments` DROP FOREIGN KEY `comments_proposals0_FK`;
ALTER TABLE `comments` ADD  CONSTRAINT `comments_proposals0_FK` FOREIGN KEY (`id_proposals`) REFERENCES `proposals`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comments` DROP FOREIGN KEY `comments_reviews_FK`;
ALTER TABLE `comments` ADD  CONSTRAINT `comments_reviews_FK` FOREIGN KEY (`id_reviews`) REFERENCES `reviews`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `comments` DROP FOREIGN KEY `comments_users2_FK`;
ALTER TABLE `comments` ADD  CONSTRAINT `comments_users2_FK` FOREIGN KEY (`id_users`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


SET FOREIGN_KEY_CHECKS = 1;
#------------------------------------------------------------
# INSERT
#------------------------------------------------------------

INSERT INTO `ranks` (`rank`) VALUES ('membre');
INSERT INTO `ranks` (`rank`) VALUES ('mod');
INSERT INTO `ranks` (`rank`) VALUES ('admin');

INSERT INTO `questions` (`question`) VALUES ('Quel est le nom de votre premier animal de compagnie?');

INSERT INTO `articleTypes` (`articleType`) VALUES ('Film');
INSERT INTO `articleTypes` (`articleType`) VALUES ('Série');
INSERT INTO `articleTypes` (`articleType`) VALUES ('Documentaire');
INSERT INTO `articleTypes` (`articleType`) VALUES ('Vidéo');
INSERT INTO `articleTypes` (`articleType`) VALUES ('Livre');
INSERT INTO `articleTypes` (`articleType`) VALUES ('Comics');

INSERT INTO `users` 
        (`pseudo`, `password`, `email`, `secretAnswer`, `newsletter`, `birthDate`, `creationDate`, `experience`, `id_questions`, `id_ranks`) 
        VALUES
        ('ADMIN', '$2y$10$VC.Qnv3QniLISGGiztaI0uxP7CAtQ9CdqpVlkSgtuUUitpLsU7vla', 'emmanuel.galland117@gmail.com', 'oslo', '1', '1994-02-12', '2018-11-05 20:20:53',  '0', '1', '3');

INSERT INTO `users` 
        (`pseudo`, `password`, `email`, `secretAnswer`, `newsletter`, `birthDate`, `creationDate`, `experience`, `id_questions`, `id_ranks`) 
        VALUES
        ('anonyme','anon', '$2y$10$AfLMM7bKuY2k/f0kJvC/7efFgmxcf14czNrC8rl0NPmhp4KUmPt1u', 'anon','0','0000-00-00','2018-11-20 17:26:23','-9999999','1','1');

INSERT INTO `countries` (`country`) VALUES ('Afghanistan');
INSERT INTO `countries` (`country`) VALUES ('Afrique du Sud');
INSERT INTO `countries` (`country`) VALUES ('Aland');
INSERT INTO `countries` (`country`) VALUES ('Albanie');
INSERT INTO `countries` (`country`) VALUES ('Algérie');
INSERT INTO `countries` (`country`) VALUES ('Allemagne');
INSERT INTO `countries` (`country`) VALUES ('Andorre');
INSERT INTO `countries` (`country`) VALUES ('Angola');
INSERT INTO `countries` (`country`) VALUES ('Anguilla');
INSERT INTO `countries` (`country`) VALUES ('Antarctique');
INSERT INTO `countries` (`country`) VALUES ('Antigua-et-Barbuda');
INSERT INTO `countries` (`country`) VALUES ('Arabie saoudite');
INSERT INTO `countries` (`country`) VALUES ('Argentine');
INSERT INTO `countries` (`country`) VALUES ('Arménie');
INSERT INTO `countries` (`country`) VALUES ('Aruba');
INSERT INTO `countries` (`country`) VALUES ('Australie');
INSERT INTO `countries` (`country`) VALUES ('Autriche');
INSERT INTO `countries` (`country`) VALUES ('Azerbaïdjan');
INSERT INTO `countries` (`country`) VALUES ('Bahamas');
INSERT INTO `countries` (`country`) VALUES ('Bahreïn');
INSERT INTO `countries` (`country`) VALUES ('Bangladesh');
INSERT INTO `countries` (`country`) VALUES ('Barbade');
INSERT INTO `countries` (`country`) VALUES ('Biélorussie');
INSERT INTO `countries` (`country`) VALUES ('Belgique');
INSERT INTO `countries` (`country`) VALUES ('Belize');
INSERT INTO `countries` (`country`) VALUES ('Bénin');
INSERT INTO `countries` (`country`) VALUES ('Bermudes');
INSERT INTO `countries` (`country`) VALUES ('Bhoutan');
INSERT INTO `countries` (`country`) VALUES ('Bolivie');
INSERT INTO `countries` (`country`) VALUES ('Bonaire');
INSERT INTO `countries` (`country`) VALUES ('Bosnie-Herzégovine');
INSERT INTO `countries` (`country`) VALUES ('Botswana');
INSERT INTO `countries` (`country`) VALUES ('Île Bouvet');
INSERT INTO `countries` (`country`) VALUES ('Brésil');
INSERT INTO `countries` (`country`) VALUES ('Brunei');
INSERT INTO `countries` (`country`) VALUES ('Bulgarie');
INSERT INTO `countries` (`country`) VALUES ('Burkina Faso');
INSERT INTO `countries` (`country`) VALUES ('Burundi');
INSERT INTO `countries` (`country`) VALUES ('Îles Caïmans');
INSERT INTO `countries` (`country`) VALUES ('Cambodge');
INSERT INTO `countries` (`country`) VALUES ('Cameroun');
INSERT INTO `countries` (`country`) VALUES ('Canada');
INSERT INTO `countries` (`country`) VALUES ('Cap-Vert');
INSERT INTO `countries` (`country`) VALUES ('République centrafricaine');
INSERT INTO `countries` (`country`) VALUES ('Chili');
INSERT INTO `countries` (`country`) VALUES ('Chine');
INSERT INTO `countries` (`country`) VALUES ('Île Christmas');
INSERT INTO `countries` (`country`) VALUES ('Chypre');
INSERT INTO `countries` (`country`) VALUES ('Îles Cocos');
INSERT INTO `countries` (`country`) VALUES ('Colombie');
INSERT INTO `countries` (`country`) VALUES ('Comores');
INSERT INTO `countries` (`country`) VALUES ('République du Congo');
INSERT INTO `countries` (`country`) VALUES ('République démocratique du Congo');
INSERT INTO `countries` (`country`) VALUES ('Îles Cook');
INSERT INTO `countries` (`country`) VALUES ('Corée du Sud');
INSERT INTO `countries` (`country`) VALUES ('Corée du Nord');
INSERT INTO `countries` (`country`) VALUES ('Costa Rica');
INSERT INTO `countries` (`country`) VALUES ("Côte d'Ivoire");
INSERT INTO `countries` (`country`) VALUES ('Croatie');
INSERT INTO `countries` (`country`) VALUES ('Cuba');
INSERT INTO `countries` (`country`) VALUES ('Curaçao');
INSERT INTO `countries` (`country`) VALUES ('Danemark');
INSERT INTO `countries` (`country`) VALUES ('Djibouti');
INSERT INTO `countries` (`country`) VALUES ('République dominicaine');
INSERT INTO `countries` (`country`) VALUES ('Dominique');
INSERT INTO `countries` (`country`) VALUES ('Égypte');
INSERT INTO `countries` (`country`) VALUES ('Salvador');
INSERT INTO `countries` (`country`) VALUES ('Émirats arabes unis');
INSERT INTO `countries` (`country`) VALUES ('Équateur');
INSERT INTO `countries` (`country`) VALUES ('Érythrée');
INSERT INTO `countries` (`country`) VALUES ('Espagne');
INSERT INTO `countries` (`country`) VALUES ('Estonie');
INSERT INTO `countries` (`country`) VALUES ('États-Unis');
INSERT INTO `countries` (`country`) VALUES ('Éthiopie');
INSERT INTO `countries` (`country`) VALUES ('Îles Malouines');
INSERT INTO `countries` (`country`) VALUES ('Îles Féroé');
INSERT INTO `countries` (`country`) VALUES ('Fidji');
INSERT INTO `countries` (`country`) VALUES ('Finlande');
INSERT INTO `countries` (`country`) VALUES ('France');
INSERT INTO `countries` (`country`) VALUES ('Gabon');
INSERT INTO `countries` (`country`) VALUES ('Gambie');
INSERT INTO `countries` (`country`) VALUES ('Géorgie');
INSERT INTO `countries` (`country`) VALUES ('Géorgie du Sud-et-les Îles Sandwich du Sud');
INSERT INTO `countries` (`country`) VALUES ('Ghana');
INSERT INTO `countries` (`country`) VALUES ('Gibraltar');
INSERT INTO `countries` (`country`) VALUES ('Grèce');
INSERT INTO `countries` (`country`) VALUES ('Grenade');
INSERT INTO `countries` (`country`) VALUES ('Groenland');
INSERT INTO `countries` (`country`) VALUES ('Guadeloupe');
INSERT INTO `countries` (`country`) VALUES ('Guam');
INSERT INTO `countries` (`country`) VALUES ('Guatemala');
INSERT INTO `countries` (`country`) VALUES ('Guernesey');
INSERT INTO `countries` (`country`) VALUES ('Guinée');
INSERT INTO `countries` (`country`) VALUES ('Guinée-Bissau');
INSERT INTO `countries` (`country`) VALUES ('Guinée équatoriale');
INSERT INTO `countries` (`country`) VALUES ('Guyana');
INSERT INTO `countries` (`country`) VALUES ('Guyane');
INSERT INTO `countries` (`country`) VALUES ('Haïti');
INSERT INTO `countries` (`country`) VALUES ('Îles Heard-et-MacDonald');
INSERT INTO `countries` (`country`) VALUES ('Honduras');
INSERT INTO `countries` (`country`) VALUES ('Hong Kong');
INSERT INTO `countries` (`country`) VALUES ('Hongrie');
INSERT INTO `countries` (`country`) VALUES ('Île de Man');
INSERT INTO `countries` (`country`) VALUES ('Îles mineures éloignées des États-Unis');
INSERT INTO `countries` (`country`) VALUES ('Îles Vierges britanniques');
INSERT INTO `countries` (`country`) VALUES ('Îles Vierges des États-Unis');
INSERT INTO `countries` (`country`) VALUES ('Inde');
INSERT INTO `countries` (`country`) VALUES ('Indonésie');
INSERT INTO `countries` (`country`) VALUES ('Iran');
INSERT INTO `countries` (`country`) VALUES ('Irak');
INSERT INTO `countries` (`country`) VALUES ('Irlande');
INSERT INTO `countries` (`country`) VALUES ('Islande');
INSERT INTO `countries` (`country`) VALUES ('Israël');
INSERT INTO `countries` (`country`) VALUES ('Italie');
INSERT INTO `countries` (`country`) VALUES ('Jamaïque');
INSERT INTO `countries` (`country`) VALUES ('Japon');
INSERT INTO `countries` (`country`) VALUES ('Jersey');
INSERT INTO `countries` (`country`) VALUES ('Jordanie');
INSERT INTO `countries` (`country`) VALUES ('Kazakhstan');
INSERT INTO `countries` (`country`) VALUES ('Kenya');
INSERT INTO `countries` (`country`) VALUES ('Kirghizistan');
INSERT INTO `countries` (`country`) VALUES ('Kiribati');
INSERT INTO `countries` (`country`) VALUES ('Koweït');
INSERT INTO `countries` (`country`) VALUES ('Laos');
INSERT INTO `countries` (`country`) VALUES ('Lesotho');
INSERT INTO `countries` (`country`) VALUES ('Lettonie');
INSERT INTO `countries` (`country`) VALUES ('Liban');
INSERT INTO `countries` (`country`) VALUES ('Liberia');
INSERT INTO `countries` (`country`) VALUES ('Libye');
INSERT INTO `countries` (`country`) VALUES ('Liechtenstein');
INSERT INTO `countries` (`country`) VALUES ('Lituanie');
INSERT INTO `countries` (`country`) VALUES ('Luxembourg');
INSERT INTO `countries` (`country`) VALUES ('Macao');
INSERT INTO `countries` (`country`) VALUES ('Macédoine');
INSERT INTO `countries` (`country`) VALUES ('Madagascar');
INSERT INTO `countries` (`country`) VALUES ('Malaisie');
INSERT INTO `countries` (`country`) VALUES ('Malawi');
INSERT INTO `countries` (`country`) VALUES ('Maldives');
INSERT INTO `countries` (`country`) VALUES ('Mali');
INSERT INTO `countries` (`country`) VALUES ('Malte');
INSERT INTO `countries` (`country`) VALUES ('Îles Mariannes du Nord');
INSERT INTO `countries` (`country`) VALUES ('Maroc');
INSERT INTO `countries` (`country`) VALUES ('Marshall');
INSERT INTO `countries` (`country`) VALUES ('Martinique');
INSERT INTO `countries` (`country`) VALUES ('Maurice');
INSERT INTO `countries` (`country`) VALUES ('Mauritanie');
INSERT INTO `countries` (`country`) VALUES ('Mayotte');
INSERT INTO `countries` (`country`) VALUES ('Mexique');
INSERT INTO `countries` (`country`) VALUES ('Micronésie');
INSERT INTO `countries` (`country`) VALUES ('Moldavie');
INSERT INTO `countries` (`country`) VALUES ('Monaco');
INSERT INTO `countries` (`country`) VALUES ('Mongolie');
INSERT INTO `countries` (`country`) VALUES ('Monténégro');
INSERT INTO `countries` (`country`) VALUES ('Montserrat');
INSERT INTO `countries` (`country`) VALUES ('Mozambique');
INSERT INTO `countries` (`country`) VALUES ('Birmanie');
INSERT INTO `countries` (`country`) VALUES ('Namibie');
INSERT INTO `countries` (`country`) VALUES ('Nauru');
INSERT INTO `countries` (`country`) VALUES ('Népal');
INSERT INTO `countries` (`country`) VALUES ('Nicaragua');
INSERT INTO `countries` (`country`) VALUES ('Niger');
INSERT INTO `countries` (`country`) VALUES ('Nigeria');
INSERT INTO `countries` (`country`) VALUES ('Niue');
INSERT INTO `countries` (`country`) VALUES ('Île Norfolk');
INSERT INTO `countries` (`country`) VALUES ('Norvège');
INSERT INTO `countries` (`country`) VALUES ('Nouvelle-Calédonie');
INSERT INTO `countries` (`country`) VALUES ('Nouvelle-Zélande');
INSERT INTO `countries` (`country`) VALUES ("Territoire britannique de l'océan Indien");
INSERT INTO `countries` (`country`) VALUES ('Oman');
INSERT INTO `countries` (`country`) VALUES ('Ouganda');
INSERT INTO `countries` (`country`) VALUES ('Ouzbékistan');
INSERT INTO `countries` (`country`) VALUES ('Pakistan');
INSERT INTO `countries` (`country`) VALUES ('Palaos');
INSERT INTO `countries` (`country`) VALUES ('Autorité Palestinienne');
INSERT INTO `countries` (`country`) VALUES ('Panama');
INSERT INTO `countries` (`country`) VALUES ('Papouasie-Nouvelle-Guinée');
INSERT INTO `countries` (`country`) VALUES ('Paraguay');
INSERT INTO `countries` (`country`) VALUES ('Pays-Bas');
INSERT INTO `countries` (`country`) VALUES ('Pérou');
INSERT INTO `countries` (`country`) VALUES ('Philippines');
INSERT INTO `countries` (`country`) VALUES ('Îles Pitcairn');
INSERT INTO `countries` (`country`) VALUES ('Pologne');
INSERT INTO `countries` (`country`) VALUES ('Polynésie française');
INSERT INTO `countries` (`country`) VALUES ('Porto Rico');
INSERT INTO `countries` (`country`) VALUES ('Portugal');
INSERT INTO `countries` (`country`) VALUES ('Qatar');
INSERT INTO `countries` (`country`) VALUES ('La Réunion');
INSERT INTO `countries` (`country`) VALUES ('Roumanie');
INSERT INTO `countries` (`country`) VALUES ('Royaume-Uni');
INSERT INTO `countries` (`country`) VALUES ('Russie');
INSERT INTO `countries` (`country`) VALUES ('Rwanda');
INSERT INTO `countries` (`country`) VALUES ('Sahara occidental');
INSERT INTO `countries` (`country`) VALUES ('Saint-Barthélemy');
INSERT INTO `countries` (`country`) VALUES ('Saint-Christophe-et-Niévès');
INSERT INTO `countries` (`country`) VALUES ('Saint-Marin');
INSERT INTO `countries` (`country`) VALUES ('Saint-Martin (Antilles françaises)');
INSERT INTO `countries` (`country`) VALUES ('Saint-Martin');
INSERT INTO `countries` (`country`) VALUES ('Saint-Pierre-et-Miquelon');
INSERT INTO `countries` (`country`) VALUES ('Saint-Siège (État de la Cité du Vatican)');
INSERT INTO `countries` (`country`) VALUES ('Saint-Vincent-et-les-Grenadines');
INSERT INTO `countries` (`country`) VALUES ('Sainte-Hélène');
INSERT INTO `countries` (`country`) VALUES ('Sainte-Lucie');
INSERT INTO `countries` (`country`) VALUES ('Salomon');
INSERT INTO `countries` (`country`) VALUES ('Samoa');
INSERT INTO `countries` (`country`) VALUES ('Samoa américaines');
INSERT INTO `countries` (`country`) VALUES ('Sao Tomé-et-Principe');
INSERT INTO `countries` (`country`) VALUES ('Sénégal');
INSERT INTO `countries` (`country`) VALUES ('Serbie');
INSERT INTO `countries` (`country`) VALUES ('Seychelles');
INSERT INTO `countries` (`country`) VALUES ('Sierra Leone');
INSERT INTO `countries` (`country`) VALUES ('Singapour');
INSERT INTO `countries` (`country`) VALUES ('Slovaquie');
INSERT INTO `countries` (`country`) VALUES ('Slovénie');
INSERT INTO `countries` (`country`) VALUES ('Somalie');
INSERT INTO `countries` (`country`) VALUES ('Soudan');
INSERT INTO `countries` (`country`) VALUES ('Soudan du Sud');
INSERT INTO `countries` (`country`) VALUES ('Sri Lanka');
INSERT INTO `countries` (`country`) VALUES ('Suède');
INSERT INTO `countries` (`country`) VALUES ('Suisse');
INSERT INTO `countries` (`country`) VALUES ('Suriname');
INSERT INTO `countries` (`country`) VALUES ('Svalbard et Île Jan Mayen');
INSERT INTO `countries` (`country`) VALUES ('Swaziland');
INSERT INTO `countries` (`country`) VALUES ('Syrie');
INSERT INTO `countries` (`country`) VALUES ('Tadjikistan');
INSERT INTO `countries` (`country`) VALUES ('Taïwan / (République de Chine (Taïwan))');
INSERT INTO `countries` (`country`) VALUES ('Tanzanie');
INSERT INTO `countries` (`country`) VALUES ('Tchad');
INSERT INTO `countries` (`country`) VALUES ('République tchèque');
INSERT INTO `countries` (`country`) VALUES ('Terres australes et antarctiques françaises');
INSERT INTO `countries` (`country`) VALUES ('Thaïlande');
INSERT INTO `countries` (`country`) VALUES ('Timor oriental');
INSERT INTO `countries` (`country`) VALUES ('Togo');
INSERT INTO `countries` (`country`) VALUES ('Tokelau');
INSERT INTO `countries` (`country`) VALUES ('Tonga');
INSERT INTO `countries` (`country`) VALUES ('Trinité-et-Tobago');
INSERT INTO `countries` (`country`) VALUES ('Tunisie');
INSERT INTO `countries` (`country`) VALUES ('Turkménistan');
INSERT INTO `countries` (`country`) VALUES ('Îles Turques-et-Caïques');
INSERT INTO `countries` (`country`) VALUES ('Turquie');
INSERT INTO `countries` (`country`) VALUES ('Tuvalu');
INSERT INTO `countries` (`country`) VALUES ('Ukraine');
INSERT INTO `countries` (`country`) VALUES ('Uruguay');
INSERT INTO `countries` (`country`) VALUES ('Vanuatu');
INSERT INTO `countries` (`country`) VALUES ('Venezuela');
INSERT INTO `countries` (`country`) VALUES ('Viêt Nam');
INSERT INTO `countries` (`country`) VALUES ('Wallis-et-Futuna');
INSERT INTO `countries` (`country`) VALUES ('Yémen');
INSERT INTO `countries` (`country`) VALUES ('Zambie');
INSERT INTO `countries` (`country`) VALUES ('Zimbabwe');

INSERT INTO `nationalities` (`nationality`) VALUES ('Afghane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Albanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Algerienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Allemande');
INSERT INTO `nationalities` (`nationality`) VALUES ('Americaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Andorrane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Angolaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Antiguaise et barbudienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Argentine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Armenienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Australienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Autrichienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Azerbaïdjanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bahamienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bahreinienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bangladaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Barbadienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Belge');
INSERT INTO `nationalities` (`nationality`) VALUES ('Belizienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Beninoise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bhoutanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bielorusse');
INSERT INTO `nationalities` (`nationality`) VALUES ('Birmane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bissau-Guinéenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bolivienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bosnienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Botswanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bresilienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Britannique');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bruneienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Bulgare');
INSERT INTO `nationalities` (`nationality`) VALUES ('Burkinabe');
INSERT INTO `nationalities` (`nationality`) VALUES ('Burundaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Cambodgienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Camerounaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Canadienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Cap-verdienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Centrafricaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Chilienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Chinoise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Chypriote');
INSERT INTO `nationalities` (`nationality`) VALUES ('Colombienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Comorienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Congolaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Costaricaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Croate');
INSERT INTO `nationalities` (`nationality`) VALUES ('Cubaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Danoise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Djiboutienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Dominicaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Dominiquaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Egyptienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Emirienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Equato-guineenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Equatorienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Erythreenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Espagnole');
INSERT INTO `nationalities` (`nationality`) VALUES ('Est-timoraise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Estonienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Ethiopienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Fidjienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Finlandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Française');
INSERT INTO `nationalities` (`nationality`) VALUES ('Gabonaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Gambienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Georgienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Ghaneenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Grenadienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Guatemalteque');
INSERT INTO `nationalities` (`nationality`) VALUES ('Guineenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Guyanienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Haïtienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Hellenique');
INSERT INTO `nationalities` (`nationality`) VALUES ('Hondurienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Hongroise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Indienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Indonesienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Irakienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Irlandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Islandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Israélienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Italienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Ivoirienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Jamaïcaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Japonaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Jordanienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Kazakhstanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Kenyane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Kirghize');
INSERT INTO `nationalities` (`nationality`) VALUES ('Kiribatienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Kittitienne-et-nevicienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Kossovienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Koweitienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Laotienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Lesothane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Lettone');
INSERT INTO `nationalities` (`nationality`) VALUES ('Libanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Liberienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Libyenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Liechtensteinoise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Lituanienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Luxembourgeoise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Macedonienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Malaisienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Malawienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Maldivienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Malgache');
INSERT INTO `nationalities` (`nationality`) VALUES ('Malienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Maltaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Marocaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Marshallaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Mauricienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Mauritanienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Mexicaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Micronesienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Moldave');
INSERT INTO `nationalities` (`nationality`) VALUES ('Monegasque');
INSERT INTO `nationalities` (`nationality`) VALUES ('Mongole');
INSERT INTO `nationalities` (`nationality`) VALUES ('Montenegrine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Mozambicaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Namibienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Nauruane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Neerlandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Neo-zelandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Nepalaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Nicaraguayenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Nigeriane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Nigerienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Nord-coréenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Norvegienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Omanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Ougandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Ouzbeke');
INSERT INTO `nationalities` (`nationality`) VALUES ('Pakistanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Palau');
INSERT INTO `nationalities` (`nationality`) VALUES ('Palestinienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Panameenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Papouane-neoguineenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Paraguayenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Peruvienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Philippine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Polonaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Portoricaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Portugaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Qatarienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Roumaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Russe');
INSERT INTO `nationalities` (`nationality`) VALUES ('Rwandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Saint-lucienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Saint-marinaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Saint-vincentaise-et-grenadine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Salomonaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Salvadorienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Samoane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Santomeenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Saoudienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Senegalaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Serbe');
INSERT INTO `nationalities` (`nationality`) VALUES ('Seychelloise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Sierra-leonaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Singapourienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Slovaque');
INSERT INTO `nationalities` (`nationality`) VALUES ('Slovene');
INSERT INTO `nationalities` (`nationality`) VALUES ('Somalienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Soudanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Sri-lankaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Sud-africaine');
INSERT INTO `nationalities` (`nationality`) VALUES ('Sud-coréenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Suedoise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Suisse');
INSERT INTO `nationalities` (`nationality`) VALUES ('Surinamaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Swazie');
INSERT INTO `nationalities` (`nationality`) VALUES ('Syrienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tadjike');
INSERT INTO `nationalities` (`nationality`) VALUES ('Taiwanaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tanzanienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tchadienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tcheque');
INSERT INTO `nationalities` (`nationality`) VALUES ('Thaïlandaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Togolaise');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tonguienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Trinidadienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tunisienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Turkmene');
INSERT INTO `nationalities` (`nationality`) VALUES ('Turque');
INSERT INTO `nationalities` (`nationality`) VALUES ('Tuvaluane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Ukrainienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Uruguayenne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Vanuatuane');
INSERT INTO `nationalities` (`nationality`) VALUES ('Venezuelienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Vietnamienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Yemenite');
INSERT INTO `nationalities` (`nationality`) VALUES ('Zambienne');
INSERT INTO `nationalities` (`nationality`) VALUES ('Zimbabweenne');

INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (0, 0 ,'#1c04ae');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (1, 900 ,'#2505b0');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (2, 2700 ,'#2e07b2');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (3, 5400 ,'#3809b4');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (4, 9000 ,'#410bb6');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (5, 13500 ,'#4a0cb8');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (6, 18900 ,'#540eba');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (7, 25200 ,'#5d10bc');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (8, 32400 ,'#6612be');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (9, 40500 ,'#7013c0');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (10, 49500 ,'#7915c2');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (11, 59400 ,'#8317c4');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (12, 70200 ,'#8c19c5');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (13, 81900 ,'#951bc7');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (14, 94500 ,'#9f1cc9');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (15, 108000 ,'#a81ecb');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (16, 122400 ,'#b120cd');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (17, 137700 ,'#bb22cf');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (18, 153900 ,'#c423d1');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (19, 171000 ,'#cd25d3');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (20, 189000 ,'#d727d5');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (21, 207900 ,'#e029d7');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (22, 227700 ,'#e92ad9');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (23, 248400 ,'#f32cdb');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (24, 270000 ,'#fc2edd');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (25, 292500 ,'#f82cd5');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (26, 315900 ,'#f42acc');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (27, 340200 ,'#f029c4');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (28, 365400 ,'#ec27bb');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (29, 391500 ,'#e825b3');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (30, 418500 ,'#e423ab');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (31, 446400 ,'#e022a2');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (32, 475200 ,'#dc209a');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (33, 504900 ,'#d81e92');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (34, 535500 ,'#d41c89');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (35, 567000 ,'#d01b81');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (36, 599400 ,'#c81770');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (37, 632700 ,'#c31568');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (38, 666900 ,'#bf135f');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (39, 702000 ,'#bb1257');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (40, 738000 ,'#b7104e');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (41, 774900 ,'#b30e46');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (42, 812700 ,'#af0c3e');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (43, 851400 ,'#ab0b35');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (44, 891000 ,'#a7092d');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (45, 931500 ,'#a30725');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (46, 972900 ,'#9f051c');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (47, 1015200 ,'#9b0414');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (48, 1058400 ,'#97020b');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (49, 1102500 ,'#930003');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (50, 1147500 ,'#840002');
INSERT INTO `levels` (`level`, `levelxp`, `color`) VALUES (51, 99999999 ,'#65ff00');

INSERT INTO `rewards`(`reward`) VALUES (10);
INSERT INTO `rewards`(`reward`) VALUES (25);
INSERT INTO `rewards`(`reward`) VALUES (500);
INSERT INTO `rewards`(`reward`) VALUES (10000);
INSERT INTO `rewards`(`reward`) VALUES (25000);
INSERT INTO `rewards`(`reward`) VALUES (50000);

INSERT INTO `jobs`(`job`) VALUES ('Acteur');
INSERT INTO `jobs`(`job`) VALUES ('Réalisateur');