<?php

// definizione della dipendenza esterna
require_once 'DBHandler.php';

// definizione di un nuovo gestore della connessione al db
$db = new DBHandler ();

// definizione dell'array associativo di risposta
$response = array("error" => TRUE);

// se tutti i campi sono stati completati
if (isset($_POST['username'])) {

	// definizione dei vari campi da quelli passati in post
	$username = $_POST ['username'];

	// definizione della lista dei tour
	$notification_list = $db->get_notifications($username);
		
	// se si acquisiscono delle notifiche
	if ($notification_list != null) {

		// definizione dell'errore
		$response ["error"] = FALSE;

		// definizione delle attività
		$response ["notifications"] = $notification_list;
		
	} else {
		
		$response["error"] = TRUE;
		
		$response["error_msg"] = "Error in acquiring notifications";
	}
	
	echo json_encode(refactoring_in_UTF8($response));

} else { // se qualche campo è incompleto

	// definizione dell'errore
	$response ["error"] = TRUE;

	// definizione del messaggio di errore
	$response ["error_msg"] = "Missing some fields";

	// invio della risposta sotto forma di json
	echo json_encode ($response);
}


// funzione per convertire i caratteri che non sono in UTF-8 in tale formato
function refactoring_in_UTF8($data_struct) {
	
    if (is_array($data_struct)) {
		
        foreach ($data_struct as $key => $value) 	
            $data_struct[$key] = refactoring_in_UTF8($value);
        
    } elseif (is_string($data_struct)) {
		
        return mb_convert_encoding($data_struct, "UTF-8", "UTF-8");
    }
	
    return $data_struct;
}

?>