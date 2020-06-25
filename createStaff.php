    <?php 

    require_once('classes/all.php');

    $create = new All($connect);

    $username = mysqli_real_escape_string($connect, $_POST['name']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $company = $_POST['company'];
    $branch = $_POST['branch'];
    $designation = $_POST['designation'];
    $password = mysqli_real_escape_string($connect, $_POST['pass']);

    $create->createStaff($username, $phone, $company, $branch, $designation, $password);

    ?>