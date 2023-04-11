PRAGMA FOREIGN_KEYS = ON;

DROP TABLE IF EXISTS TicketHashtag;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS TicketStatus;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS User;

/*******************************************************************************
   Create Tables
********************************************************************************/

CREATE TABLE User (
    userID INTEGER NOT NULL AUTOINCREMENT,
    username TEXT NOT NULL,
    firstName TEXT NOT NULL,
    lastName TEXT NOT NULL,
    password TEXT NOT NULL,
    email TEXT NOT NULL,
    phone CHAR(9),

    CONSTRAINT PK_User PRIMARY KEY (userID)
);

CREATE TABLE Hashtag (
    hashtagID INTEGER NOT NULL AUTOINCREMENT,
    hastag UNIQUE TEXT NOT NULL,

    constraint PK_Hashtag PRIMARY KEY (hashtagID)
);

CREATE TABLE TicketStatus (
    ticketStatusID INTEGER NOT NULL AUTOINCREMENT,
    statusName TEXT NOT NULL,

    CONSTRAINT PK_TicketStatus PRIMARY KEY (ticketStatusID)
);

CREATE TABLE Ticket (
    ticketID INTEGER NOT NULL AUTOINCREMENT,
    userID INTEGER NOT NULL,
    ticketStatusID INTEGER NOT NULL,

    CONSTRAINT PK_Ticket PRIMARY KEY (ticketID),
    FOREIGN KEY (userID) REFERENCES User(userID) ON UPDATE CASCADE,
    FOREIGN KEY (ticketStatusID) REFERENCES TicketStatus(ticketStatusID) ON UPDATE CASCADE
);

CREATE TABLE TicketHashtag (
    ticketID INTEGER NOT NULL,
    hashtagID INTEGER NOT NULL,

    CONSTRAINT PK_TicketHashtag PRIMARY KEY (ticketID, hashtagID),
    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
    FOREIGN KEY (hashtagID) REFERENCES Hashtag(hashtagID)
);
