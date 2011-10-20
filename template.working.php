	<tr>
	  <th>Kollege</th>
	  <th>Projekt</th>
      <th>Seit</th>
	  <th>Aktionen</th>
	</tr>
    <?php for ($i=0; $i<count($Worker); $i++): ?>
	<tr class="<?php echo $i%2?"odd":"even"; ?>">
      <td><?php echo $Worker[$i]['Collegue'] ?></td>
      <td><?php echo $Worker[$i]['Project'] ?></td>
      <td><?php echo $Worker[$i]['Time'] ?></td>
      <td>
        <input type="button" class="abort" title="Abbrechen" value="✕" />
        <input type="button" class="save"  title="Beenden & Speichern" value="✓" />
      </td>
    </tr>
       <?php endfor; ?>
	<tr class="<?php echo $i%2?"odd":"even"; ?>">
      <td><input type="text" name="name"    value="<Kollege>" /></td>
      <td><input type="text" name="project" value="<Projekt>" /></td>
      <td>-</td>
      <td><input type="button" class="start" title="Beginnen" value="►" /></td>
    </tr>