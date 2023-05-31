<?php

/**
 * Used to running database query
 *
 * @param string mysql query
 *
 * return mixed
 */
function run_query(string $query) {
    // Établir une connexion à la base de données en utilisant les informations de connexion
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    // Vérifier si la connexion a échoué
    if ($connection->connect_errno) {
        throw new Exception("Database connection failed: " . $connection->connect_error);
    }

    // Exécuter la requête SQL en utilisant la méthode query de l'objet mysqli
    if (!$result = $connection->query($query)) {
        throw new Exception("Query execution failed: " . $connection->error);
    }

    // Retourner le résultat de la requête
    return $result;
}


/**
 * Used to create an INSERT query
 *
 * @param $table table name
 * @param $datas array the data to be inserted
 *
 * return bolean
 */
function insert(string $table, array $datas) {
    // Établir une connexion à la base de données
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    // Vérifier si la connexion a échoué
    if ($connection->connect_errno) {
        throw new Exception("Database connection failed: " . $connection->connect_error);
    }

    // Créer des tableaux pour stocker les colonnes et les valeurs
    $dataColumn = [];
    $dataValues = [];

    // Parcourir le tableau associatif de données à insérer
    foreach ($datas as $column => $value) {
        // Échapper les colonnes et les valeurs pour éviter les attaques par injection SQL
        $dataColumn[] = $connection->real_escape_string($column);
        $dataValues[] = "'" . $connection->real_escape_string($value) . "'";
    }

    // Construire la chaîne de colonnes et de valeurs pour la requête INSERT
    $columns = implode(",", $dataColumn);
    $values = implode(",", $dataValues);

    // Construire la requête INSERT
    $query = "INSERT INTO $table ($columns) VALUES ($values)";

    // Exécuter la requête INSERT en utilisant la fonction run_query
    if (!$result = run_query($query)) {
        throw new Exception("Query execution failed: " . $connection->error);
    }

    // Retourner le résultat de l'exécution de la requête
    return $result;
}

/**
 * @param string table name
 * @param string column
 * @param array conditions
 *
 * return array if has some data, false otherwise
 */
function select(string $table, string $column = null, $conditions = array()) {
    if(empty($column)) {
        $column = "*";
    }

    $query = "SELECT {$column} FROM {$table}";
    if(!empty($conditions)) {
        $query .= " WHERE {$conditions[0]} {$conditions[1]} '{$conditions[2]}'";
    }

    if (!$result = run_query($query)) {
        throw new Exception('Error when looking to the data');
    } else {
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}

/**
 *
 */
function find(string $table, array $conditions) {
    $result = select($table, null, $conditions);
    return $result[0];
}
