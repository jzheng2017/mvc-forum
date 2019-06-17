SELECT u.*, (SELECT COUNT(ur.rating) FROM user_reputation ur WHERE ur.user_id = u.id AND ur.rating = 1)
                                        -
                                        (SELECT COUNT(ur.rating) FROM user_reputation ur WHERE ur.user_id = u.id AND ur.rating = -1) as reputation,
                                        (SELECT COUNT(*) FROM thread_posts tp WHERE tp.user_id = u.id) as post_count
                                        FROM users u
                                        WHERE u.id = ?