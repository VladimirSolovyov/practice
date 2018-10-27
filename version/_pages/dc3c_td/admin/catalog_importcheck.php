<?

foreach ($this->result as $key => $row) {

	switch (true) {

		case $row['tsn'] == '':
		{
			$this->skip($row, tr('не указан артикул','dc'));
		}
			break;
		case $row['no_in'] == 'yes':
		{
			$this->skip($row, tr('позиция отсутствует в каталоге','dc'));
		}
			break;

		default:
			{
			$this->add($row);
			}
			break;

	}

}

?>
