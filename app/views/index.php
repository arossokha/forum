<?php
if(count($data)) {
    echo "<table>";
    echo "<thead>";
        echo "<tr>";
        foreach ($data[0]->getAttributeNames() as $name) {
            echo "<th>{$name}</th>";
        }
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
        foreach($data as $theme) {
            echo "</tr>";
            foreach ($data[0]->getAttributeNames() as $attribute => $name) {
                echo '<td>'.$theme->{$attribute}.'</td>';
            }
            echo "</tr>";
        }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "Список тем пуст";
}