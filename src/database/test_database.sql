PRAGMA FOREIGN_KEYS = ON;

/*Drop Tables*/

DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Agent;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS FAQ;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Status;
DROP TABLE IF EXISTS Change;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS User;

/*Create Tables*/

CREATE TABLE User (
    userID INTEGER NOT NULL AUTOINCREMENT,
    name TEXT NOT NULL,
    username TEXT NOT NULL,
    passw TEXT NOT NULL,
    email TEXT NOT NULL,

    CONSTRAINT PK_User PRIMARY KEY (userID)
);

CREATE TABLE Agent (
    userID INTEGER NOT NULL,

    FOREIGN KEY (userID) REFERENCES User(userID),
    CONSTRAINT PK_Agent PRIMARY KEY (userID)
);

CREATE TABLE Admin (
    userID INTEGER NOT NULL,

    FOREIGN KEY (userID) REFERENCES Agent(userID),
    CONSTRAINT PK_Admin PRIMARY KEY (userID)
);


CREATE TABLE FAQ (
    faqID INTEGER NOT NULL AUTOINCREMENT,
    userID INTEGER NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,

    FOREIGN KEY (userID) REFERENCES Agent(userID),
    CONSTRAINT PK_FAQ PRIMARY KEY (faqID)
);

CREATE TABLE Task (
    taskID INTEGER NOT NULL AUTOINCREMENT,
    agentID INTEGER NOT NULL,
    content TEXT NOT NULL,

    FOREIGN KEY (agentID) REFERENCES Agent(userID),
    CONSTRAINT PK_Task PRIMARY KEY (taskID)
);

CREATE TABLE Status (
    statusID INTEGER NOT NULL AUTOINCREMENT,
    adminID INTEGER NOT NULL,
    name TEXT NOT NULL,

    FOREIGN KEY (adminID) REFERENCES Admin(userID),
    CONSTRAINT PK_Status PRIMARY KEY (statusID)
);

CREATE TABLE Department (
    departmentID INTEGER NOT NULL AUTOINCREMENT,
    adminID INTEGER NOT NULL,
    name TEXT NOT NULL,

    FOREIGN KEY (adminID) REFERENCES Admin(userID),
    CONSTRAINT PK_Department PRIMARY KEY (departmentID)
);

CREATE TABLE Hashtag (
    hashtagID INTEGER NOT NULL AUTOINCREMENT,
    adminID INTEGER NOT NULL,
    name TEXT NOT NULL,

    FOREIGN KEY (adminID) REFERENCES Admin(userID),
    CONSTRAINT PK_Hashtag PRIMARY KEY (hashtagID)
);

CREATE TABLE Ticket (
    ticketID INTEGER NOT NULL AUTOINCREMENT,
    clientID INTEGER NOT NULL,
    departmentID INTEGER NOT NULL,
    taskID INTEGER NOT NULL,
    status_name TEXT NOT NULL,
    title TEXT NOT NULL
    priority INTEGER NOT NULL,
    da DATE NOT NULL,

    FOREIGN KEY (clientID) REFERENCES User(userID),
    FOREIGN KEY (departmentID) REFERENCES Department(departmentID),
    FOREIGN KEY (taskID) REFERENCES Task(taskID),
    FOREIGN KEY (status_name) REFERENCES Status(name),
    CONSTRAINT Diferent CHECK (clientID != agentID),
    CONSTRAINT PK_Ticket PRIMARY KEY (ticketID)
);

CREATE TABLE TicketAgent (
    ticket_agentID INTEGER NOT NULL AUTOINCREMENT,
    ticketID INTEGER NOT NULL,
    agentID INTEGER NOT NULL,

    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
    FOREIGN KEY (agentID) REFERENCES Agent(userID),
    CONSTRAINT PK_TicketAgent PRIMARY KEY (ticket_agentID)
);

CREATE TABLE TicketHashtag (
    ticket_hashtagID INTEGER NOT NULL AUTOINCREMENT,
    ticketID INTEGER NOT NULL,
    hashtagID INTEGER NOT NULL,

    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
    FOREIGN KEY (hashtagID) REFERENCES Hashtag(hashtagID),
    CONSTRAINT PK_TicketHashtag PRIMARY KEY (ticket_hashtagID)
);

CREATE TABLE Message (
    messageID INTEGER NOT NULL AUTOINCREMENT,
    userID INTEGER NOT NULL,
    ticketID INTEGER NOT NULL,
    da DATE NOT NULL,
    content TEXT NOT NULL,

    FOREIGN KEY (userID) REFERENCES User(userID),
    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
    CONSTRAINT PK_Message PRIMARY KEY (messageID)
);

CREATE TABLE Change (
    changeID INTEGER NOT NULL AUTOINCREMENT,
    agentID INTEGER NOT NULL,
    ticketID INTEGER NOT NULL,
    da DATE NOT NULL,
    content TEXT NOT NULL,

    FOREIGN KEY (agentID) REFERENCES Agent(userID),
    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
    CONSTRAINT PK_Change PRIMARY KEY (changeID) 
);


CREATE TABLE AgentDepartment (
    agent_departmentID INTEGER NOT NULL AUTOINCREMENT,
    agentID INTEGER NOT NULL,
    departmentID INTEGER NOT NULL,

    FOREIGN KEY (agentID) REFERENCES Agent(userID),
    FOREIGN KEY (departmentID) REFERENCES Department(departmentID),
    CONSTRAINT PK_AgentDepartment PRIMARY KEY (agent_departmentID)
);