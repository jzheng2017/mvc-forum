SELECT u.id, u.username, ur.title, up.points FROM users u, user_points up, user_ranks ur WHERE u.id = up.user_id AND u.rank = ur.rank ORDER BY ur.rank DESC, points DESC