<?php
$search_param = $_POST["search"];
$search_area = $_POST["area"];
if(isset($_POST['search']) && isset($_POST['area'])) {
    
    $search_param = $_POST['search'];
    $search_area = $_POST['area'];

    // validate search_area and search_param
    if(empty($search_area) || empty($search_param)) {
        $data["result"] = "False";
        $data["Message"] = "Invalid search parameters";
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

    // validate search_area format (assuming it should be a string)
    if(!is_string($search_area)) {
        $data["result"] = "False";
        $data["Message"] = "Invalid search area format";
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

    // validate search_param format (assuming it should be a string)
    if(!is_string($search_param)) {
        $data["result"] = "False";
        $data["Message"] = "Invalid search parameter format";
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }

    // if validation passes, proceed with the SQL query
    $host= "localhost";
    $dbuser= "id20455233_healthbuddy";
    $dbpass= "2c{=q!2aiwTX=2nC";
    $dbname= "id20455233_27122002";

    $conn= new mysqli($host, $dbuser, $dbpass, $dbname);

    $sql = "SELECT * from doctors";

    $result=$conn->query($sql);

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc()){
            $doctorid = $row["ID"];
            $doctorname = $row["Doctor_name"];
            $doctorspecialization = $row["Specialization"];
            $doctorarea = $row["Doctor_area"];
           
            
            $doctor_data = array();
            $doctor_data["DocName"] = $doctorname;
            $doctor_data["Specialization"] = $doctorspecialization;
            $doctor_data["Docarea"] = $doctorarea;
          

            $data[$doctorid] = $doctor_data;
        }

        $data["result"] = "True";
        $data["Message"] = "Doctors fetched successfully";

    } else {
        $data["result"] = "False";
        $data["Message"] = "No Doctors Found";
    }

} else {
    $data["result"] = "False";
    $data["Message"] = "Bad query";
}

echo json_encode($data , JSON_UNESCAPED_SLASHES);

?>
