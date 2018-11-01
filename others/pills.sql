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
        id        Int NOT NULL ,
        name      Varchar (100) NOT NULL ,
        birthDate Date NOT NULL ,
        deathDate Date NOT NULL ,
        biography Text NOT NULL ,
        image     Varchar (100) NOT NULL
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
# Table: levels
#------------------------------------------------------------

CREATE TABLE levels(
        id      Int NOT NULL ,
        level   Int NOT NULL ,
        reachXp Int NOT NULL
	,CONSTRAINT levels_PK PRIMARY KEY (id)
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
        id_questions Int NOT NULL ,
        id_levels    Int NOT NULL ,
        id_ranks     Int NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (id)

	,CONSTRAINT users_questions_FK FOREIGN KEY (id_questions) REFERENCES questions(id)
	,CONSTRAINT users_levels0_FK FOREIGN KEY (id_levels) REFERENCES levels(id)
	,CONSTRAINT users_ranks1_FK FOREIGN KEY (id_ranks) REFERENCES ranks(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reviews
#------------------------------------------------------------

CREATE TABLE reviews(
        id         Int NOT NULL ,
        title      Varchar (255) NOT NULL ,
        review     Text NOT NULL ,
        date       Date NOT NULL ,
        image      Varchar (100) NOT NULL ,
        id_artists Int NOT NULL ,
        id_users   Int NOT NULL
	,CONSTRAINT reviews_PK PRIMARY KEY (id)

	,CONSTRAINT reviews_artists_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT reviews_users0_FK FOREIGN KEY (id_users) REFERENCES users(id)
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
        id_users           Int NOT NULL
	,CONSTRAINT scores_PK PRIMARY KEY (id)

	,CONSTRAINT scores_culturalObjects_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
	,CONSTRAINT scores_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
	,CONSTRAINT scores_users1_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: validations
#------------------------------------------------------------

CREATE TABLE validations(
        id         Int NOT NULL ,
        validation Bool NOT NULL
	,CONSTRAINT validations_PK PRIMARY KEY (id)
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
        id               Int NOT NULL ,
        id_nationalities Int NOT NULL
	,CONSTRAINT ACONationalities_PK PRIMARY KEY (id)

	,CONSTRAINT ACONationalities_nationalities_FK FOREIGN KEY (id_nationalities) REFERENCES nationalities(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: AOCCountries
#------------------------------------------------------------

CREATE TABLE AOCCountries(
        id           Int NOT NULL ,
        id_countries Int NOT NULL
	,CONSTRAINT AOCCountries_PK PRIMARY KEY (id)

	,CONSTRAINT AOCCountries_countries_FK FOREIGN KEY (id_countries) REFERENCES countries(id)
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
        id        Int NOT NULL ,
        id_genres Int NOT NULL
	,CONSTRAINT COGenres_PK PRIMARY KEY (id)

	,CONSTRAINT COGenres_genres_FK FOREIGN KEY (id_genres) REFERENCES genres(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: trailers
#------------------------------------------------------------

CREATE TABLE trailers(
        id      Int NOT NULL ,
        trailer Varchar (100) NOT NULL
	,CONSTRAINT trailers_PK PRIMARY KEY (id)
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
        id     Int NOT NULL ,
        id_VOD Int NOT NULL
	,CONSTRAINT COVOD_PK PRIMARY KEY (id)

	,CONSTRAINT COVOD_VOD_FK FOREIGN KEY (id_VOD) REFERENCES VOD(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reports
#------------------------------------------------------------

CREATE TABLE reports(
        id       Int NOT NULL ,
        report   Text NOT NULL ,
        usersId  Int NOT NULL ,
        id_users Int NOT NULL
	,CONSTRAINT reports_AK UNIQUE (usersId)
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
# Table: ARTISTS CAN HAVE NATIONNALIES
#------------------------------------------------------------

CREATE TABLE ARTISTS_CAN_HAVE_NATIONNALIES(
        id         Int NOT NULL ,
        id_artists Int NOT NULL
	,CONSTRAINT ARTISTS_CAN_HAVE_NATIONNALIES_PK PRIMARY KEY (id,id_artists)

	,CONSTRAINT ARTISTS_CAN_HAVE_NATIONNALIES_ACONationalities_FK FOREIGN KEY (id) REFERENCES ACONationalities(id)
	,CONSTRAINT ARTISTS_CAN_HAVE_NATIONNALIES_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CULTURALOBJECTS CAN HAVE GENRE
#------------------------------------------------------------

CREATE TABLE CULTURALOBJECTS_CAN_HAVE_GENRE(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_GENRE_PK PRIMARY KEY (id,id_culturalObjects)

	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_GENRE_COGenres_FK FOREIGN KEY (id) REFERENCES COGenres(id)
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_GENRE_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CULTURALOBJECTS CAN HAVE COUNTRIES
#------------------------------------------------------------

CREATE TABLE CULTURALOBJECTS_CAN_HAVE_COUNTRIES(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_COUNTRIES_PK PRIMARY KEY (id,id_culturalObjects)

	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_COUNTRIES_AOCCountries_FK FOREIGN KEY (id) REFERENCES AOCCountries(id)
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_COUNTRIES_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ARTISTS CAN HAVE COUNTRIES
#------------------------------------------------------------

CREATE TABLE ARTISTS_CAN_HAVE_COUNTRIES(
        id         Int NOT NULL ,
        id_artists Int NOT NULL
	,CONSTRAINT ARTISTS_CAN_HAVE_COUNTRIES_PK PRIMARY KEY (id,id_artists)

	,CONSTRAINT ARTISTS_CAN_HAVE_COUNTRIES_AOCCountries_FK FOREIGN KEY (id) REFERENCES AOCCountries(id)
	,CONSTRAINT ARTISTS_CAN_HAVE_COUNTRIES_artists0_FK FOREIGN KEY (id_artists) REFERENCES artists(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CULTURALOBJECTS CAN HAVE NATIONALITY
#------------------------------------------------------------

CREATE TABLE CULTURALOBJECTS_CAN_HAVE_NATIONALITY(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_NATIONALITY_PK PRIMARY KEY (id,id_culturalObjects)

	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_NATIONALITY_ACONationalities_FK FOREIGN KEY (id) REFERENCES ACONationalities(id)
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_NATIONALITY_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: USERS CAN VALIDATE VALIDATIONS
#------------------------------------------------------------

CREATE TABLE USERS_CAN_VALIDATE_VALIDATIONS(
        id       Int NOT NULL ,
        id_users Int NOT NULL
	,CONSTRAINT USERS_CAN_VALIDATE_VALIDATIONS_PK PRIMARY KEY (id,id_users)

	,CONSTRAINT USERS_CAN_VALIDATE_VALIDATIONS_validations_FK FOREIGN KEY (id) REFERENCES validations(id)
	,CONSTRAINT USERS_CAN_VALIDATE_VALIDATIONS_users0_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CULTURALOBJECTS CAN HAVE DISTRIBUTORS
#------------------------------------------------------------

CREATE TABLE CULTURALOBJECTS_CAN_HAVE_DISTRIBUTORS(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_DISTRIBUTORS_PK PRIMARY KEY (id,id_culturalObjects)

	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_DISTRIBUTORS_distributors_FK FOREIGN KEY (id) REFERENCES distributors(id)
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_DISTRIBUTORS_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: USERS CAN HAVE REWARDS
#------------------------------------------------------------

CREATE TABLE USERS_CAN_HAVE_REWARDS(
        id       Int NOT NULL ,
        id_users Int NOT NULL
	,CONSTRAINT USERS_CAN_HAVE_REWARDS_PK PRIMARY KEY (id,id_users)

	,CONSTRAINT USERS_CAN_HAVE_REWARDS_rewards_FK FOREIGN KEY (id) REFERENCES rewards(id)
	,CONSTRAINT USERS_CAN_HAVE_REWARDS_users0_FK FOREIGN KEY (id_users) REFERENCES users(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CULTURALOBJECTS CAN HAVE TRAILERS
#------------------------------------------------------------

CREATE TABLE CULTURALOBJECTS_CAN_HAVE_TRAILERS(
        id                 Int NOT NULL ,
        id_culturalObjects Int NOT NULL
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_TRAILERS_PK PRIMARY KEY (id,id_culturalObjects)

	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_TRAILERS_trailers_FK FOREIGN KEY (id) REFERENCES trailers(id)
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_TRAILERS_culturalObjects0_FK FOREIGN KEY (id_culturalObjects) REFERENCES culturalObjects(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: CULTURALOBJECTS CAN HAVE COVOD
#------------------------------------------------------------

CREATE TABLE CULTURALOBJECTS_CAN_HAVE_COVOD(
        id       Int NOT NULL ,
        id_COVOD Int NOT NULL
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_COVOD_PK PRIMARY KEY (id,id_COVOD)

	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_COVOD_culturalObjects_FK FOREIGN KEY (id) REFERENCES culturalObjects(id)
	,CONSTRAINT CULTURALOBJECTS_CAN_HAVE_COVOD_COVOD0_FK FOREIGN KEY (id_COVOD) REFERENCES COVOD(id)
)ENGINE=InnoDB;

