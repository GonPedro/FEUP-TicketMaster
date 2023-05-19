INSERT INTO Agent VALUES (1, 0);
INSERT INTO Admin VALUES (1, 0);

INSERT INTO Status(adminID,name) VALUES (1, "open");
INSERT INTO Status(adminID,name) VALUES (1, "closed");
INSERT INTO Status(adminID,name) VALUES (1, "assigned");

INSERT INTO Department(adminID, name) VALUES (1, "Anime");
INSERT INTO Department(adminID, name) VALUES (1, "Website");
INSERT INTO Department(adminID, name) VALUES (1, "Accounting");
INSERT INTO Department(adminID, name) VALUES (1, "Programming");
INSERT INTO Department(adminID, name) VALUES (1, "Game Dev");


INSERT INTO Hashtag(adminID, name) VALUES (1, "#Waifu");
INSERT INTO Hashtag(adminID, name) VALUES (1, "#Rats");
INSERT INTO Hashtag(adminID, name) VALUES (1, "#Programming");
INSERT INTO Hashtag(adminID, name) VALUES (1, "#Filters");

INSERT INTO AgentDepartment(agentID,departmentID) VALUES (1, 1);
INSERT INTO AgentDepartment(agentID,departmentID) VALUES (1, 3);


INSERT INTO Ticket(clientID, department, status_name, title, priority, da) VALUES (1,"Anime", "open", "Hatsune Miku",1, 2222-22-22);

INSERT INTO TicketHashtag(ticketID, hashtagID) VALUES (1, 1);
INSERT INTO TicketHashtag(ticketID, hashtagID) VALUES (1, 3);


INSERT INTO FAQ(userID, title, content) VALUES (1, "How do i code in PHP?", "After soaking in your own tears for about a week");

