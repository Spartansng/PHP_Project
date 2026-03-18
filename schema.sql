DROP TABLE IF EXISTS user_achievements;
DROP TABLE IF EXISTS user_games;
DROP TABLE IF EXISTS achievements;
DROP TABLE IF EXISTS levels;
DROP TABLE IF EXISTS games;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       username TEXT UNIQUE NOT NULL,
                       email TEXT UNIQUE NOT NULL,
                       password_hash TEXT NOT NULL,
                       role TEXT DEFAULT 'user',
                       created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE games (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       title TEXT NOT NULL,
                       description TEXT,
                       genre TEXT,
                       rating INTEGER,
                       image_url TEXT,
                       release_date TEXT,
                       difficulty TEXT,
                       created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE levels (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        game_id INTEGER,
                        level_number INTEGER,
                        difficulty TEXT
);

CREATE TABLE achievements (
                              id INTEGER PRIMARY KEY AUTOINCREMENT,
                              name TEXT NOT NULL,
                              description TEXT
);

CREATE TABLE user_games (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            user_id INTEGER,
                            game_id INTEGER,
                            play_time INTEGER DEFAULT 0,
                            play_time_minutes INTEGER DEFAULT 0,
                            status TEXT
);

CREATE TABLE user_achievements (
                                   id INTEGER PRIMARY KEY AUTOINCREMENT,
                                   user_id INTEGER,
                                   achievement_id INTEGER,
                                   unlocked_at DATETIME DEFAULT CURRENT_TIMESTAMP
);