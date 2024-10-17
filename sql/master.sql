-- contries table

INSERT INTO countries (name) VALUES ('India');

-- student table

INSERT INTO students (first_name, last_name, dob, gender, city_id,state_id.country_id) VALUES
('John', 'Doe', '2000-01-01', 'Male', 1, 1, 1);


-- states table

INSERT INTO states (name, country_id) VALUES
('Andhra Pradesh', 1),
('Arunachal Pradesh', 1),
('Assam', 1),
('Bihar', 1),
('Chhattisgarh', 1),
('Goa', 1),
('Gujarat', 1),
('Haryana', 1),
('Himachal Pradesh', 1),
('Jharkhand', 1),
('Karnataka', 1),
('Kerala', 1),
('Madhya Pradesh', 1),
('Maharashtra', 1),
('Manipur', 1),
('Meghalaya', 1),
('Mizoram', 1),
('Nagaland', 1),
('Odisha', 1),
('Punjab', 1),
('Rajasthan', 1),
('Sikkim', 1),
('Tamil Nadu', 1),
('Telangana', 1),
('Tripura', 1),
('Uttar Pradesh', 1),
('Uttarakhand', 1),
('West Bengal', 1),
('Andaman and Nicobar Islands', 1),
('Chandigarh', 1),
('Dadra and Nagar Haveli and Daman and Diu', 1),
('Lakshadweep', 1),
('Delhi', 1),
('Puducherry', 1),
('Ladakh', 1),
('Jammu and Kashmir', 1);



-- cities table

INSERT INTO cities (name, state_id) VALUES
('Visakhapatnam', 1), -- Andhra Pradesh
('Itanagar', 2),      -- Arunachal Pradesh
('Guwahati', 3),      -- Assam
('Patna', 4),         -- Bihar
('Raipur', 5),        -- Chhattisgarh
('Panaji', 6),        -- Goa
('Ahmedabad', 7),     -- Gujarat
('Gurugram', 8),      -- Haryana
('Shimla', 9),        -- Himachal Pradesh
('Ranchi', 10),       -- Jharkhand
('Bangalore', 11),    -- Karnataka
('Kochi', 12),        -- Kerala
('Indore', 13),       -- Madhya Pradesh
('Mumbai', 14),       -- Maharashtra
('Imphal', 15),       -- Manipur
('Shillong', 16),     -- Meghalaya
('Aizawl', 17),       -- Mizoram
('Kohima', 18),       -- Nagaland
('Bhubaneswar', 19),  -- Odisha
('Amritsar', 20),     -- Punjab
('Jaipur', 21),       -- Rajasthan
('Gangtok', 22),      -- Sikkim
('Chennai', 23),      -- Tamil Nadu
('Hyderabad', 24),    -- Telangana
('Agartala', 25),     -- Tripura
('Lucknow', 26),      -- Uttar Pradesh
('Dehradun', 27),     -- Uttarakhand
('Kolkata', 28),      -- West Bengal
('Port Blair', 29),   -- Andaman and Nicobar Islands
('Chandigarh', 30),   -- Chandigarh
('Daman', 31),        -- Dadra and Nagar Haveli and Daman and Diu
('Kavaratti', 32),    -- Lakshadweep
('New Delhi', 33),    -- Delhi
('Puducherry', 34),   -- Puducherry
('Leh', 35),          -- Ladakh
('Srinagar', 36);     -- Jammu and Kashmir


--Subject table

INSERT INTO subjects (name) VALUES
('Maths'), 
('Science'),      
('English'),     
('Social science'),
('Physics'), 
('Chemistry'),    
('Hindi');       
