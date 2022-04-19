<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/includes/connection.php';
$db_connection = new Database();
$conn = $db_connection->connect();

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ], $extra);
}

// DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") :

    $returnData = msg(0, 404, 'Page Not Found!');

elseif (
    !isset($data->ime)
    || !isset($data->prezime)
    || !isset($data->oib)
    || !isset($data->email)
    || !isset($data->lozinka)
    || empty(trim($data->ime))
    || empty(trim($data->prezime))
    || empty(trim($data->email))
    || empty(trim($data->lozinka))
) :

    $fields = ['fields' => ['ime', 'prezime', 'oib', 'email', 'lozinka']];
    $returnData = msg(0, 422, 'Molimo popunite sva polja!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $ime = trim($data->ime);
    $prezime = trim($data->prezime);
    $oib = trim($data->oib);
    $email = trim($data->email);
    $lozinka = trim($data->lozinka);
    $selectedOption=$data->selectedOption;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        $returnData = msg(0, 422, 'Nevažeća email adresa!');

    elseif (strlen($lozinka) < 8) :
        $returnData = msg(0, 422, 'Vaša lozinka mora sadržavati barem osam znakova!');

    elseif (strlen($ime) < 3) :
        $returnData = msg(0, 422, 'Vaše ime mora sadržavati barem 3 slova!');

    elseif (strlen($prezime) < 3) :
        $returnData = msg(0, 422, 'Vaše prezime mora sadržavati barem 3 slova!');

    elseif (strlen($oib) < 11) :
        $returnData = msg(0, 422, 'Vaš oib mora sadržavati 11 znamenaka!');

    else :
        try {

            $check_email = "SELECT `email` FROM `login` WHERE `email`=:email";
            $check_email_stmt = $conn->prepare($check_email);
            $check_email_stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $check_email_stmt->execute();

            if ($check_email_stmt->rowCount()) :
                $returnData = msg(0, 422, 'Ova email adresa već postoji!');

            else :
                $uloga="Pacijent";
                $insert_query = "INSERT INTO `login`(`ime`,`prezime`,`oib`,`email`,`lozinka`,`uloga`) VALUES(:ime,:prezime,:oib,:email,:lozinka,:uloga)";
                $insert_query2 = "INSERT INTO `pacijenti`(`imep`,`prezimep`,`oib`,`uloga`,`doktor`) VALUES(:ime,:prezime,:oib,:uloga,:selectedOption)";

                $insert_stmt = $conn->prepare($insert_query);
                $insert_stmt2 = $conn->prepare($insert_query2);

                // DATA BINDING
                $insert_stmt->bindValue(':ime', htmlspecialchars(strip_tags($ime)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':prezime', htmlspecialchars(strip_tags($prezime)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':oib', htmlspecialchars(strip_tags($oib)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $insert_stmt->bindValue(':lozinka', password_hash($lozinka, PASSWORD_DEFAULT), PDO::PARAM_STR);
                $insert_stmt->bindValue(':uloga', htmlspecialchars(strip_tags($uloga)), PDO::PARAM_STR);

                $insert_stmt2->bindValue(':ime', htmlspecialchars(strip_tags($ime)), PDO::PARAM_STR);
                $insert_stmt2->bindValue(':prezime', htmlspecialchars(strip_tags($prezime)), PDO::PARAM_STR);
                $insert_stmt2->bindValue(':oib', htmlspecialchars(strip_tags($oib)), PDO::PARAM_STR);
                $insert_stmt2->bindValue(':uloga', htmlspecialchars(strip_tags($uloga)), PDO::PARAM_STR);
                $insert_stmt2->bindValue(':selectedOption', htmlspecialchars(strip_tags($selectedOption)), PDO::PARAM_STR);

                $insert_stmt->execute();
                $insert_stmt2->execute();

                $returnData = msg(1, 201, 'Uspješno ste registrirani!');

            endif;
        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;
endif;

echo json_encode($returnData);