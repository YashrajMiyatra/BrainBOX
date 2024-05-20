<?php
// Connect to your database (replace these with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brainbox";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to get total number of users
function getTotalUsers($conn) {
    $sql = "SELECT COUNT(*) as total_users FROM user";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_users'];
    } else {
        return 0;
    }
}

// Function to get active users in the last 1 day
function getActiveUsers($conn) {
    $sql = "SELECT COUNT(DISTINCT user_id) as active_users FROM user_actions WHERE action_date >= NOW() - INTERVAL 1 DAY";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['active_users'];
    } else {
        return 0;
    }
}

// Function to get new users in the last 1 day
function getNewUsers($conn) {
    $sql = "SELECT COUNT(*) as new_users FROM user WHERE DATE(registration_date) = CURDATE()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['new_users'];
    } else {
        return 0;
    }
}

// Function to get monthly, 15 days, weekly, and daily traffic
function getTrafficStats($conn) {
    $sql = "SELECT
                COUNT(*) as monthly_traffic,
                COUNT(*) as '15_days_traffic',
                COUNT(*) as weekly_traffic,
                COUNT(*) as daily_traffic
            FROM user_actions
            WHERE action_date >= NOW() - INTERVAL 30 DAY"; // You can adjust the intervals as needed

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return array(
            'monthly_traffic' => 0,
            '15_days_traffic' => 0,
            'weekly_traffic' => 0,
            'daily_traffic' => 0
        );
    }
}

// Function to get new discussions
function getNewDiscussions($conn) {
    $sql = "SELECT COUNT(*) as new_discussions FROM discussion WHERE DATE(discussion_date) = CURDATE()";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['new_discussions'];
    } else {
        return 0;
    }
}

// Function to get discussion participation
function getDiscussionParticipation($conn) {
    $sql = "SELECT
                d.discussion_name,
                u.username as created_by,
                j.user_id as joined_user
            FROM discussion d
            LEFT JOIN user u ON d.discussion_admin_id = u.user_id
            LEFT JOIN join_discussion j ON d.discussion_id = j.discussion_id
            ORDER BY d.discussion_date DESC
            LIMIT 5"; // You can adjust the limit as needed

    $result = $conn->query($sql);

    $discussionParticipation = array();
    while ($row = $result->fetch_assoc()) {
        $discussionParticipation[] = $row;
    }

    return $discussionParticipation;
}

// Function to get reported questions
function getReportedQuestions($conn) {
    $sql = "SELECT
                r.reported_by_user_id,
                u.username as reporter,
                q.question_id,
                q.question_txt,
                q.post_by as reported_question_user
            FROM report_question r
            LEFT JOIN user u ON r.reported_by_user_id = u.user_id
            LEFT JOIN question q ON r.question_id = q.question_id";

    $result = $conn->query($sql);

    $reportedQuestions = array();
    while ($row = $result->fetch_assoc()) {
        $reportedQuestions[] = $row;
    }

    return $reportedQuestions;
}

// Function to get content by tag (e.g., JAVA)
function getContentByTag($conn, $tag) {
    $sql = "SELECT * FROM question WHERE que_keyword = '$tag'";

    $result = $conn->query($sql);

    $contentByTag = array();
    while ($row = $result->fetch_assoc()) {
        $contentByTag[] = $row;
    }

    return $contentByTag;
}

// Function to get user profiles
function getUserProfiles($conn) {
    $sql = "SELECT * FROM profile";

    $result = $conn->query($sql);

    $userProfiles = array();
    while ($row = $result->fetch_assoc()) {
        $userProfiles[] = $row;
    }

    return $userProfiles;
}

// Function to get user responses
function getUserResponses($conn) {
    $sql = "SELECT * FROM user_responses";

    $result = $conn->query($sql);

    $userResponses = array();
    while ($row = $result->fetch_assoc()) {
        $userResponses[] = $row;
    }

    return $userResponses;
}

// Function to get like statistics
function getLikeStatistics($conn) {
    $sql = "SELECT
                question_id,
                COUNT(CASE WHEN like_type = 'like' THEN 1 END) as likes,
                COUNT(CASE WHEN like_type = 'dislike' THEN 1 END) as dislikes
            FROM question_likes
            GROUP BY question_id";

    $result = $conn->query($sql);

    $likeStatistics = array();
    while ($row = $result->fetch_assoc()) {
        $likeStatistics[$row['question_id']] = array(
            'likes' => $row['likes'],
            'dislikes' => $row['dislikes']
        );
    }

    return $likeStatistics;
}

// Function to get keyword statistics
function getKeywordStatistics($conn) {
    $sql = "SELECT
                keyword,
                COUNT(*) as frequency
            FROM keyword
            GROUP BY keyword";

    $result = $conn->query($sql);

    $keywordStatistics = array();
    while ($row = $result->fetch_assoc()) {
        $keywordStatistics[$row['keyword']] = $row['frequency'];
    }

    return $keywordStatistics;
}

// Usage example
$totalUsers = getTotalUsers($conn);
$activeUsers = getActiveUsers($conn);
$newUsers = getNewUsers($conn);
$trafficStats = getTrafficStats($conn);
$newDiscussions = getNewDiscussions($conn);
$discussionParticipation = getDiscussionParticipation($conn);
$reportedQuestions = getReportedQuestions($conn);
$contentByJavaTag = getContentByTag($conn, 'JAVA');
$userProfiles = getUserProfiles($conn);
$userResponses = getUserResponses($conn);
$likeStatistics = getLikeStatistics($conn);
$keywordStatistics = getKeywordStatistics($conn);

// Close the database connection
$conn->close();
?>

<!-- HTML part to display the information in the admin panel -->
<div>
    <h2>Total Users: <?php echo $totalUsers; ?></h2>
    <h2>Active Users: <?php echo $activeUsers; ?></h2>
    <h2>New Users (Last 1 Day): <?php echo $newUsers; ?></h2>

    <h2>Traffic Stats:</h2>
    <ul>
        <li>Monthly Traffic: <?php echo $trafficStats['monthly_traffic']; ?></li>
        <li>15 Days Traffic: <?php echo $trafficStats['15_days_traffic']; ?></li>
        <li>Weekly Traffic: <?php echo $trafficStats['weekly_traffic']; ?></li>
        <li>Daily Traffic: <?php echo $trafficStats['daily_traffic']; ?></li>
    </ul>

    <h2>New Discussions (Last 1 Day): <?php echo $newDiscussions; ?></h2>

    <h2>Discussion Participation:</h2>
    <ul>
        <?php foreach ($discussionParticipation as $participation): ?>
            <li>User <?php echo $participation['created_by']; ?> created and user <?php echo $participation['joined_user']; ?> joined discussion "<?php echo $participation['discussion_name']; ?>"</li>
        <?php endforeach; ?>
    </ul>

    <h2>Reported Questions:</h2>
    <ul>
        <?php foreach ($reportedQuestions as $reportedQuestion): ?>
            <li>User <?php echo $reportedQuestion['reporter']; ?> reported question "<?php echo $reportedQuestion['question_txt']; ?>" by User <?php echo $reportedQuestion['reported_question_user']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Content by Tag (JAVA):</h2>
    <ul>
        <?php foreach ($contentByJavaTag as $content): ?>
            <li>Question: <?php echo $content['question_txt']; ?>, Posted by: <?php echo $content['post_by']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>User Profiles:</h2>
    <ul>
        <?php foreach ($userProfiles as $profile): ?>
            <li>User: <?php echo $profile['username']; ?>, Profile Name: <?php echo $profile['profile_name']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>User Responses:</h2>
    <ul>
        <?php foreach ($userResponses as $response): ?>
            <li>User <?php echo $response['user_id']; ?> responded to question <?php echo $response['question_id']; ?> with: <?php echo $response['response_text']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Like Statistics:</h2>
    <ul>
        <?php foreach ($likeStatistics as $questionId => $stats): ?>
            <li>Question <?php echo $questionId; ?> - Likes: <?php echo $stats['likes']; ?>, Dislikes: <?php echo $stats['dislikes']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Keyword Statistics:</h2>
    <ul>
        <?php foreach ($keywordStatistics as $keyword => $frequency): ?>
            <li>Keyword: <?php echo $keyword; ?> - Frequency: <?php echo $frequency; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
