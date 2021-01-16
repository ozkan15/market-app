function addNewTableRow(table) {
    let tBody = $(table).find('tbody');
    let rowCount = $(tBody).find('tr').length;
    console.log(rowCount);
    tBody.append(`
        <tr>
            <td><input type="text" placeholder="Name" name="name-${rowCount}" required /></td>
            <td><input type="number" placeholder="Price" name="price-${rowCount}" required /></td>
            <td><input type="text" placeholder="Market" name="market-${rowCount}" required /></td>
            <td><input type="file" placeholder="Image" name="image-${rowCount}" /></td>
            <td><input type="text" placeholder="Link" name="link-${rowCount}" required /></td>
            <td><a href="#" onclick="this.parentElement.parentElement.remove();"><i class="fas fa-trash"></i></a></td>
        </tr>
    `);
}