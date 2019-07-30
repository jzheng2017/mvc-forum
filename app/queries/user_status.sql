SELECT ul.type, ul.action, ul.object_id, ul.action_time
FROM user_log ul
WHERE ul.user_id = ?
AND TIMESTAMPDIFF(SECOND, action_time, now()) < 300
AND action_time = (SELECT max(action_time) FROM user_log sul WHERE sul.user_id = ul.user_id)