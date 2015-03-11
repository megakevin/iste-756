-- roles

INSERT INTO roles(id, description) VALUES (1, 'customer');
INSERT INTO roles(id, description) VALUES (2, 'admin');

-- products

INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price) 
VALUES ('Potion', 'Restores 50 HP.', 50.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Hi-Potion', 'Restores 150 HP.', 100.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('X-Potion', 'Fully restores HP.', 200.00, 10, 'picture_path.png', FALSE,NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Ether', 'Restores 50 MP.', 100.00,10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Turbo Ether', 'Restores 150 MP.', 200.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Dry Ether', 'Fully restores MP.', 400.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Elixir', 'Fully restores HP and MP.', 1000.00,10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Megalixir', 'Fully restores party''s HP and MP.', 3000.00,10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Phoenix Down', 'Revives one fallen ally.', 500.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Antidote', 'Cures Poison.', 50.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Gold Needle', 'Cures Petrify.', 500.00, 10, 'picture_path.png', FALSE, NULL);
INSERT INTO products(name, description, price, quantity_in_stock, picture, is_on_sale, sale_price)
VALUES ('Remedy', 'Cures ailments exept stone and KO.', 1500.00, 10, 'picture_path.png', FALSE, NULL);
