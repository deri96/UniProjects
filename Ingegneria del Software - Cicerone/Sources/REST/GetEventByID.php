<?php

// definizione della dipendenza esterna
require_once 'DBHandler.php';

// definizione di un nuovo gestore della connessione al db
$db = new DBHandler ();

// definizione dell'array associativo di risposta
$response = array("error" => TRUE);

// se tutti i campi sono stati completati
if (isset($_POST['id'])) {

	// definizione dei vari campi da quelli passati in post
	$id = $_POST ['id'];

	// definizione della lista degli eventi
	$event = $db->get_event_by_id($id);
		
	// se si acquisiscono degli eventi
	if ($event != null) {

		// definizione dell'errore
		$response ["error"] = FALSE;

		// definizione degli eventi
		$response ["event"] = $event;
		
	} else {
		
		$response["error"] = TRUE;
		
		$response["error_msg"] = "Error in acquiring events";
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