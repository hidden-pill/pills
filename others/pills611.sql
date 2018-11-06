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
# Table: culturalObjects
#------------------------------------------------------------

CREATE TABLE culturalObjects(
        id              Int NOT NULL ,
        name            Varchar (100) NOT NULL ,
        releaseDate     Date NOT NULL ,
        synopsis        Text NOT NULL ,
        image           Varchar (100) NOT NULL ,
        budget          Int NOT NULL ,
        validation      Bool NOT NULL ,
        id_articleTypes Int NOT NULL
	,CONSTRAINT culturalObjects_PK PRIMARY KEY (id)

	,CONSTRAINT culturalObjects_articleTypes_FK FOREIGN KEY (id_articleTypes) REFERENCES articleTypes(id)
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
        image      Varchar (100) NOT NULL ,
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

CREATE TABLE users(
        id           Int NOT NULL ,
        pseudo       Varchar (24) NOT NULL ,
        password     Varchar (100) NOT NULL ,
        email        Varchar (255) NOT NULL ,
        secretAnswer Varchar (50) NOT NULL ,
        newsletter   Bool NOT NULL ,
        birthDate    Date NOT NULL ,
        creationDate Date NOT NULL ,
        image        Varchar (100) NOT NULL ,
        experience   Int NOT NULL ,
        id_questions Int NOT NULL ,
        id_ranks     Int NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id)

	,CONSTRAINT users_questions_FK FOREIGN KEY (id_questions) REFERENCES questions(id)
	,CONSTRAINT users_ranks0_FK FOREIGN KEY (id_ranks) REFERENCES ranks(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reviews
#------------------------------------------------------------

CREATE TABLE reviews(
        id                 Int NOT NULL ,
        title              Varchar (255) NOT NULL ,
        review             Text NOT NULL ,
        date               Date NOT NULL ,
        image              Varchar (100) NOT NULL ,
        id_users           Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT reviews_PK PRIMARY KEY (id)

	,CONSTRAINT reviews_users_FK FOREIGN KEY (id_users) REFERENCES users(id)
	,CONSTRAINT reviews_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
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
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        id           Int NOT NULL ,
        comment      Text NOT NULL ,
        date         Date NOT NULL ,
        commentsId   Int NOT NULL ,
        id_reviews   Int NOT NULL ,
        id_proposals Int NOT NULL ,
        id_artists   Int NOT NULL ,
        id_users     Int NOT NULL
	,CONSTRAINT comments_AK UNIQUE (commentsId)
	,CONSTRAINT comments_PK PRIMARY KEY (id)

	,CONSTRAINT comments_reviews_FK FOREIGN KEY (id_reviews) REFERENCES reviews(id)
	,CONSTRAINT comments_proposals0_FK FOREIGN KEY (id_proposals) REFERENCES proposals(id)
	,CONSTRAINT comments_artists1_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT comments_users2_FK FOREIGN KEY (id_users) REFERENCES users(id)
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
        id                 Int NOT NULL ,
        score              Int NOT NULL ,
        id_culturalObjects Int NOT NULL ,
        id_artists         Int NOT NULL ,
        id_users           Int
	,CONSTRAINT scores_PK PRIMARY KEY (id)

	,CONSTRAINT scores_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
	,CONSTRAINT scores_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT scores_users1_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: levels
#------------------------------------------------------------

CREATE TABLE levels(
        id      Int NOT NULL ,
        level   Int NOT NULL ,
        reachXp Int NOT NULL
	,CONSTRAINT levels_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: distributors
#------------------------------------------------------------

CREATE TABLE distributors(
        id                 Int NOT NULL ,
        distributor        Varchar (50) NOT NULL ,
        id_culturalObjects Int
	,CONSTRAINT distributors_PK PRIMARY KEY (id)

	,CONSTRAINT distributors_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
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
# Table: ACONationalities
#------------------------------------------------------------

CREATE TABLE ACONationalities(
        id                 Int NOT NULL ,
        id_artists         Int NOT NULL ,
        id_culturalObjects Int NOT NULL ,
        id_nationalities   Int NOT NULL
	,CONSTRAINT ACONationalities_PK PRIMARY KEY (id)

	,CONSTRAINT ACONationalities_artists_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT ACONationalities_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
	,CONSTRAINT ACONationalities_nationalities1_FK FOREIGN KEY (id_nationalities) REFERENCES nationalities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AOCCountries
#------------------------------------------------------------

CREATE TABLE AOCCountries(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL ,
        id_artists         Int NOT NULL ,
        id_countries       Int NOT NULL
	,CONSTRAINT AOCCountries_PK PRIMARY KEY (id)

	,CONSTRAINT AOCCountries_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
	,CONSTRAINT AOCCountries_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT AOCCountries_countries1_FK FOREIGN KEY (id_countries) REFERENCES countries(id)
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
# Table: COGenres
#------------------------------------------------------------

CREATE TABLE COGenres(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL ,
        id_genres          Int NOT NULL
	,CONSTRAINT COGenres_PK PRIMARY KEY (id)

	,CONSTRAINT COGenres_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
	,CONSTRAINT COGenres_genres0_FK FOREIGN KEY (id_genres) REFERENCES genres(id)
	,CONSTRAINT COGenres_genres_AK UNIQUE (id_genres)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: trailers
#------------------------------------------------------------

CREATE TABLE trailers(
        id                 Int NOT NULL ,
        trailer            Varchar (100) NOT NULL ,
        id_culturalObjects Int
	,CONSTRAINT trailers_PK PRIMARY KEY (id)

	,CONSTRAINT trailers_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: VOD
#------------------------------------------------------------

CREATE TABLE VOD(
        id      Int NOT NULL ,
        website Varchar (50) NOT NULL
	,CONSTRAINT VOD_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: COVOD
#------------------------------------------------------------

CREATE TABLE COVOD(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL ,
        id_VOD             Int NOT NULL
	,CONSTRAINT COVOD_PK PRIMARY KEY (id)

	,CONSTRAINT COVOD_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
	,CONSTRAINT COVOD_VOD0_FK FOREIGN KEY (id_VOD) REFERENCES VOD(id)
	,CONSTRAINT COVOD_VOD_AK UNIQUE (id_VOD)
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
# Table: ACO
#------------------------------------------------------------

CREATE TABLE ACO(
        id                 Int NOT NULL ,
        id_artists         Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT ACO_PK PRIMARY KEY (id)

	,CONSTRAINT ACO_artists_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT ACO_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;




#------------------------------------------------------------
# ALTER
#------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `users` ADD UNIQUE( `pseudo`, `email`);

ALTER TABLE `users` 
        CHANGE `creationDate` `creationDate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
        CHANGE `image` `image` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'default_profile.png', 
        CHANGE `experience` `experience` INT(11) NOT NULL DEFAULT '0', 
        CHANGE `id_ranks` `id_ranks` INT(11) NOT NULL DEFAULT '1';

ALTER TABLE `aco` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `aconationalities` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `aoccountries` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `articletypes` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artists` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `artistsjobs` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `cogenres` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `comments` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `countries` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `covod` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `culturalobjects` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
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
ALTER TABLE `reviewstags` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rewards` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `scores` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tags` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `trailers` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `upvotes` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `vod` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;


SET FOREIGN_KEY_CHECKS = 1;
#------------------------------------------------------------
# INSERT
#------------------------------------------------------------

INSERT INTO `ranks` (`rank`) VALUES ('membre');
INSERT INTO `ranks` (`rank`) VALUES ('mod');
INSERT INTO `ranks` (`rank`) VALUES ('admin');

INSERT INTO `questions` (`question`) VALUES ('Quel est le nom de votre premier animal de compagnie?');

INSERT INTO `jobs` (`job`) VALUE ('Non renseigné');
INSERT INTO `nationalities` (`nationality`) VALUE ('Non renseigné');
INSERT INTO `countries` (`country`) VALUE ('Non renseigné');
INSERT INTO `genres` (`genre`) VALUE ('Non renseigné');
INSERT INTO `VOD` (`website`) VALUE ('Non renseigné');
INSERT INTO `artists` (`name`) VALUE ('Non renseigné');

INSERT INTO `articleTypes` (`articleType`) VALUE ('Film');
INSERT INTO `articleTypes` (`articleType`) VALUE ('Série');
INSERT INTO `articleTypes` (`articleType`) VALUE ('Documentaire');
INSERT INTO `articleTypes` (`articleType`) VALUE ('Vidéo');
INSERT INTO `articleTypes` (`articleType`) VALUE ('Livre');
INSERT INTO `articleTypes` (`articleType`) VALUE ('Comics');

INSERT INTO `users` 
        (`pseudo`, `password`, `email`, `secretAnswer`, `newsletter`, `birthDate`, `creationDate`, `image`, `experience`, `id_questions`, `id_ranks`) 
        VALUE 
        ('ADMIN', '$2y$10$VC.Qnv3QniLISGGiztaI0uxP7CAtQ9CdqpVlkSgtuUUitpLsU7vla', 'emmanuel.galland117@gmail.com', 'oslo', '1', '1994-02-12', '2018-11-05 20:20:53', 'default_profile.png', '0', '1', '3');
