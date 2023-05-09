INSERT INTO Agent VALUES (1);
INSERT INTO Admin VALUES (1);
INSERT INTO Status(adminID,name) VALUES (1, "open");
INSERT INTO Department(adminID, name) VALUES (1, "Anime");
INSERT INTO Task(agentID, content) VALUES (1, "Hatsune Miku");
INSERT INTO Ticket(clientID, departmentID, taskID, status_name, title, priority, da) VALUES (1,1,1, "open", "Hatsune Miku",1, 2222-22-22);