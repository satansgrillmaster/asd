<?php

echo '<form method="post" action="index.php" id="contact_form">';
echo '<label><p>*Name:</p><input type="text" name="firstname"></label>';
echo '<label><p>*Nachname:</p><input type="text" name="lastname"></label>';
echo '<label><p>*Email:</p><input type="text" name="email"></label><br>';
echo '<input type="radio" name="sex" value="maennlich">Männlich<br>';
echo '<input type="radio" name="sex" value="weiblich">Weiblich<br>';
echo '<fieldset  id="teaching_aids"><legend>Lehrmittel</legend><input type="checkbox" name="php"><label for="php">Php</label><br>';
echo '<input type="checkbox" name="python"><label for="python">Python</label></fieldset>';
echo '<p>Felder mit * sind obligatorisch</p>';
echo '<label><p><input type="submit" name="send_form" value="absenden"></p></label>';
echo '</form>';