SELECT t.title, tp.body, tp.thread_id, u.username
FROM thread_posts tp, threads t, users u
WHERE tp.thread_id = t.id
AND u.id = tp.user_id
AND TIMESTAMPDIFF(SECOND, tp.date_created, now()) < 86400
ORDER BY tp.date_created DESC