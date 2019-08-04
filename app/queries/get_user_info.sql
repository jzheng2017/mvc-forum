SELECT u.*,
(SELECT COUNT(ur.rating) FROM user_reputation ur WHERE ur.user_id = u.id AND ur.rating = 1) - (SELECT COUNT(ur.rating) FROM user_reputation ur WHERE ur.user_id = u.id AND ur.rating = -1) as reputation,
                                        (SELECT role FROM permissions p, users up WHERE p.id = up.permission AND up.id = u.id) as role,
                                        (SELECT title FROM user_ranks ur, users up WHERE up.rank = ur.rank AND up.id = u.id) as rank_title,
                                        (SELECT points FROM user_points ur WHERE ur.user_id = u.id) as points,
                                        (SELECT COUNT(*) FROM thread_posts tp WHERE tp.user_id = u.id) as post_count,
                                        (SELECT COUNT(*) FROM user_log ul WHERE ul.user_id = u.id AND TIMESTAMPDIFF(SECOND, action_time, now()) < 300) as status
                                        FROM users u
                                        WHERE u.id = ?