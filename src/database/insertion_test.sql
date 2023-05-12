INSERT INTO Agent VALUES (1);
INSERT INTO Admin VALUES (1);
INSERT INTO Status(adminID,name) VALUES (1, "open");
INSERT INTO Department(adminID, name) VALUES (1, "Anime");
INSERT INTO Ticket(clientID, department, status_name, title, priority, da) VALUES (1,"Anime", "open", "Hatsune Miku",1, 2222-22-22);