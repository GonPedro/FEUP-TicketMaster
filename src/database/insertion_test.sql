-- User
insert into User (fullname, username, password, email, closedTickets) values ('Burch Viall', 'bviall0', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'bviall0@etsy.com', 39);
insert into User (fullname, username, password, email, closedTickets) values ('Poul Beardwell', 'pbeardwell1', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'pbeardwell1@homestead.com', 97);
insert into User (fullname, username, password, email, closedTickets) values ('Douglas Stainer', 'dstainer2', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'dstainer2@i2i.jp', 86);
insert into User (fullname, username, password, email, closedTickets) values ('Monro Escudier', 'mescudier3', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'mescudier3@netvibes.com', 23);
insert into User (fullname, username, password, email, closedTickets) values ('Lilia Abercrombie', 'labercrombie4', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'labercrombie4@cloudflare.com', 51);
insert into User (fullname, username, password, email, closedTickets) values ('Maribel Siddell', 'msiddell5', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'msiddell5@cornell.edu', 66);
insert into User (fullname, username, password, email, closedTickets) values ('Leroi Buggs', 'lbuggs6', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'lbuggs6@dailymail.co.uk', 1);
insert into User (fullname, username, password, email, closedTickets) values ('Pernell Niccolls', 'pniccolls7', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'pniccolls7@ebay.co.uk', 96);
insert into User (fullname, username, password, email, closedTickets) values ('Caye Yoakley', 'cyoakley8', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'cyoakley8@baidu.com', 45);
insert into User (fullname, username, password, email, closedTickets) values ('Mateo Rosenkranc', 'mrosenkranc9', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'mrosenkranc9@csmonitor.com', 9);
insert into User (fullname, username, password, email, closedTickets) values ('Elsey Bloxsum', 'ebloxsuma', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'ebloxsuma@technorati.com', 68);
insert into User (fullname, username, password, email, closedTickets) values ('Giuditta Houson', 'ghousonb', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'ghousonb@free.fr', 2);
insert into User (fullname, username, password, email, closedTickets) values ('Cassie Cadwallader', 'ccadwalladerc', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'ccadwalladerc@lycos.com', 58);
insert into User (fullname, username, password, email, closedTickets) values ('Olimpia Drennan', 'odrennand', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'odrennand@house.gov', 86);
insert into User (fullname, username, password, email, closedTickets) values ('Pammi Galliver', 'pgallivere', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'pgallivere@google.com', 10);
insert into User (fullname, username, password, email, closedTickets) values ('Nana Snoding', 'nsnodingf', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'nsnodingf@gizmodo.com', 53);
insert into User (fullname, username, password, email, closedTickets) values ('Caro Asals', 'casalsg', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'casalsg@cmu.edu', 99);
insert into User (fullname, username, password, email, closedTickets) values ('Shayla Lease', 'sleaseh', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'sleaseh@woothemes.com', 26);
insert into User (fullname, username, password, email, closedTickets) values ('Justen Hurt', 'jhurti', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'jhurti@examiner.com', 87);
insert into User (fullname, username, password, email, closedTickets) values ('Bronson Starbeck', 'bstarbeckj', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'bstarbeckj@va.gov', 83);
insert into User (fullname, username, password, email, closedTickets) values ('Lissie Rodear', 'lrodeark', 'f3031e9a8eb9cf1c2355d91b8700c7e0ca33c406', 'lrodeark@goo.ne.jp', 29);

-- Agent
insert into Agent (userID) values (15);
insert into Agent (userID) values (7);
insert into Agent (userID) values (3);
insert into Agent (userID) values (5);
insert into Agent (userID) values (8);
insert into Agent (userID) values (14);
insert into Agent (userID) values (1);

-- Admin
insert into Admins (userID) values (3);
insert into Admins (userID) values (5);
insert into Admins (userID) values (8);

-- FAQ
INSERT INTO FAQ (userID, title, content) VALUES
    (1, 'How do I reset my password?', 'To reset your password, go to the login page and click on the "Forgot Password" link.'),
    (2, 'How can I update my profile picture?', 'To update your profile picture, navigate to your profile settings and upload a new image.'),
    (3, 'What are the supported payment methods?', 'We accept credit cards (Visa, Mastercard, and American Express) as well as PayPal.'),
    (4, 'How long does shipping usually take?', 'Shipping times vary depending on your location. On average, it takes 3-5 business days.'),
    (5, 'Can I cancel my order?', 'Yes, you can cancel your order within 24 hours of placing it by contacting our customer support.'),
    (6, 'How can I track my package?', 'Once your order has been shipped, you will receive a tracking number via email. You can use this number to track your package on our website.'),
    (7, 'What is your return policy?', 'We accept returns within 30 days of purchase. Please refer to our Returns and Refunds page for detailed instructions.'),
    (8, 'Are the products on your website genuine?', 'Yes, all the products on our website are genuine and sourced directly from authorized manufacturers.'),
    (9, 'How can I contact customer support?', 'You can contact our customer support team via email at support@example.com or by calling our toll-free number.'),
    (10, 'Can I change my shipping address after placing an order?', 'Yes, you can change your shipping address within 24 hours of placing the order. Please contact our customer support for assistance.'),
    (11, 'Do you offer international shipping?', 'Yes, we offer international shipping to select countries. Please check our shipping policy for more details.'),
    (12, 'What is the warranty period for your products?', 'The warranty period for our products is one year from the date of purchase.'),
    (13, 'How do I apply for a refund?', 'To apply for a refund, please fill out the refund request form on our website.'),
    (14, 'Can I return a product without its original packaging?', 'No, we require the product to be returned in its original packaging for a refund.'),
    (15, 'What is your response time for customer inquiries?', 'We strive to respond to customer inquiries within 24 hours.'),
    (16, 'How do I change my account password?', 'To change your account password, go to your account settings and select the "Change Password" option.'),
    (17, 'What are the system requirements for your software?', 'The system requirements for our software are listed on the product page.'),
    (18, 'How do I update the app to the latest version?', 'You can update the app to the latest version through the app store or by downloading the update from our website.'),
    (19, 'Can I use multiple payment methods for a single order?', 'No, currently we only support using a single payment method per order.'),
    (20, 'How do I unsubscribe from your newsletter?', 'To unsubscribe from our newsletter, click on the "Unsubscribe" link at the bottom of any newsletter email.'),
    (21, 'What should I do if I forgot my username?', 'If you forgot your username, please contact our customer support for assistance.');

-- Task
INSERT INTO Task (ticketID, agentID, content) VALUES
    (1, 1, 'Investigate the issue reported by the customer.'),
    (2, 15, 'Follow up with the vendor regarding the delayed shipment.'),
    (3, 7, 'Resolve the technical error reported in the system.'),
    (1, 1, 'Provide the customer with troubleshooting steps.'),
    (4, 3, 'Perform data analysis and generate a report.'),
    (2, 15, 'Coordinate with the logistics team to expedite the delivery.'),
    (5, 5, 'Design and develop a new feature for the application.'),
    (6, 8, 'Review and approve the proposed budget for the project.'),
    (7, 14, 'Conduct training session for the new employees.'),
    (8, 3, 'Draft a proposal for the upcoming marketing campaign.'),
    (9, 5, 'Test the software for compatibility with different operating systems.'),
    (10, 8, 'Collaborate with the design team to create a visually appealing layout.'),
    (3, 7, 'Implement the bug fix in the latest software release.'),
    (11, 1, 'Prepare the presentation for the client meeting.'),
    (12, 8, 'Research and gather market data for the market analysis report.'),
    (13, 14, 'Assist customers with their product-related inquiries.'),
    (14, 15, 'Optimize the database queries to improve performance.'),
    (15, 5, 'Conduct code review for the new feature implementation.'),
    (16, 3, 'Coordinate with the customer to schedule a product demonstration.'),
    (17, 1, 'Create user documentation for the software application.'),
    (18, 8, 'Coordinate with external stakeholders for a partnership opportunity.'),
    (19, 14, 'Provide on-site support during the product installation.'),
    (20, 5, 'Perform security testing and vulnerability assessment.'),
    (21, 8, 'Conduct interviews for the job opening in the team.');

-- Status
INSERT INTO Status (adminID, name) VALUES
    (3, 'Assigned'),
    (5, 'In Progress'),
    (8, 'Completed'),
    (3, 'Open'),
    (8, 'Closed');

-- Department
INSERT INTO Department (adminID, name) VALUES
    (3, 'Sales'),
    (5, 'Marketing'),
    (8, 'Finance'),
    (3, 'Customer Support'),
    (8, 'Human Resources');

-- Hashtag
INSERT INTO Hashtag (adminID, name) VALUES
    (3, 'sales'),
    (5, 'marketing'),
    (8, 'finance'),
    (3, 'customersupport'),
    (8, 'humanresources');

-- Ticket
INSERT INTO Ticket (clientID, department, status_name, title, priority, da) VALUES
    (1, 'Sales', 'Open', 'Product Inquiry', 5, '2023-05-15 09:30'),
    (2, 'Marketing', 'Assigned', 'Campaign Proposal', 7, '2023-05-16 14:45'),
    (3, 'Customer Support', 'In Progress', 'Technical Issue', 3, '2023-05-17 11:20'),
    (4, 'Finance', 'Completed', 'Expense Reimbursement', 8, '2023-05-18 16:10'),
    (5, 'Sales', 'Open', 'Quotation Request', 2, '2023-05-19 13:55'),
    (6, 'Human Resources', 'Assigned', 'Job Application', 6, '2023-05-20 10:05'),
    (7, 'Customer Support', 'In Progress', 'Product Return', 4, '2023-05-21 17:30'),
    (8, 'Marketing', 'Completed', 'Social Media Campaign', 9, '2023-05-22 08:45'),
    (9, 'Finance', 'Open', 'Invoice Payment', 3, '2023-05-23 12:15'),
    (10, 'Sales', 'Assigned', 'Order Status Inquiry', 7, '2023-05-24 09:55');

-- TicketAgent
INSERT INTO TicketAgent (ticketID, agentID) VALUES
    (1, 1),
    (2, 15),
    (3, 7),
    (4, 3),
    (5, 5),
    (6, 8),
    (7, 14),
    (8, 3),
    (9, 5),
    (10, 8);

-- TicketHashtag
INSERT INTO TicketHashtag (ticketID, hashtagID) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 1),
    (7, 2),
    (8, 3),
    (9, 4),
    (10, 5);

-- Message
INSERT INTO Message (userID, ticketID, da, content) VALUES
    (1, 1, '2023-05-15 09:30', 'Thank you for your inquiry. We will get back to you shortly.'),
    (15, 2, '2023-05-16 14:45', 'I have reviewed the campaign proposal. Looks great!'),
    (7, 3, '2023-05-17 11:20', 'We are actively working on resolving the technical issue.'),
    (3, 4, '2023-05-18 16:10', 'Your expense reimbursement request has been processed.'),
    (5, 5, '2023-05-19 13:55', 'We have received your quotation request. Our team will provide a response soon.'),
    (8, 6, '2023-05-20 10:05', 'Thank you for applying. We will review your application and contact you.'),
    (14, 7, '2023-05-21 17:30', 'We are processing your product return request. Please allow some time.'),
    (3, 8, '2023-05-22 08:45', 'The social media campaign has been successfully completed.'),
    (5, 9, '2023-05-23 12:15', 'Your invoice payment is due by the end of the month.'),
    (8, 10, '2023-05-24 09:55', 'We are currently investigating your order status inquiry.');

-- Change
INSERT INTO Change (agentID, ticketID, da, content) VALUES
    (1, 1, '2023-05-15 10:05', 'Updated status to "In Progress"'),
    (15, 2, '2023-05-16 15:20', 'Assigned ticket to agent with ID 15'),
    (7, 3, '2023-05-17 12:30', 'Added additional notes to the ticket'),
    (3, 4, '2023-05-18 17:45', 'Resolved the expense reimbursement request'),
    (5, 5, '2023-05-19 14:55', 'Updated priority to 2'),
    (8, 6, '2023-05-20 11:10', 'Scheduled an interview for the job application'),
    (14, 7, '2023-05-21 18:25', 'Initiated product return process'),
    (3, 8, '2023-05-22 09:35', 'Verified completion of the social media campaign'),
    (5, 9, '2023-05-23 13:40', 'Sent a payment reminder for the invoice'),
    (8, 10, '2023-05-24 10:30', 'Investigating order status inquiry');

-- AgentDepartment
INSERT INTO AgentDepartment (agentID, departmentID) VALUES
    (15, 1),
    (7, 2),
    (3, 3),
    (5, 1),
    (8, 4),
    (14, 5),
    (1, 1);
