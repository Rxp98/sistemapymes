// archivo: sales-form.js

$(document).ready(function () {
    let productCount = 0;
    const IVA_RATE = 0.10; // 10% de IVA

    // Agregar producto a la tabla
    $('#addProduct').click(function () {
        const product = $('#product').val();
        const quantity = parseInt($('#quantity').val());
        const price = Math.floor(Math.random() * 100) + 1; // Precio aleatorio para el ejemplo

        if (product && quantity > 0) {
            const total = price * quantity;
            const iva = total * IVA_RATE;
            const totalWithIva = total + iva;
            const newRow = `
                <tr id="productRow${productCount}">
                    <td>${product}</td>
                    <td><img src="https://via.placeholder.com/50" alt="Imagen del producto"></td>
                    <td>${quantity}</td>
                    <td>${price}</td>
                    <td>${total}</td>
                    <td>${iva.toFixed(2)}</td>
                    <td>${totalWithIva.toFixed(2)}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" onclick="reduceQuantity(${productCount})">-</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeProduct(${productCount})">Eliminar</button>
                    </td>
                </tr>
            `;
            $('#salesTable tbody').append(newRow);
            productCount++;
            $('#product').val('');
            $('#quantity').val('');
            updateTotals();
        } else {
            alert('Por favor, ingrese un producto y una cantidad válida.');
        }
    });

    // Cancelar la venta
    $('#cancelSale').click(function () {
        $('#salesTable tbody').empty();
        updateTotals();
    });

    // Enviar en espera
    $('#holdSale').click(function () {
        // Lógica para enviar en espera
        handleSale('enviar_espera');
    });

    // Agregar a la cuenta del cliente
    $('#addToAccount').click(function () {
        // Lógica para agregar a la cuenta del cliente
        handleSale('agregar_cuenta');
    });

    // Manejar pedidos
    $('#makeOrder').click(function () {
        // Lógica para manejar pedidos
        handleSale('pedidos');
    });

    // Presupuestar
    $('#quoteSale').click(function () {
        // Lógica para presupuestar
        handleSale('presupuestar');
    });

    // Finalizar la venta
    $('#salesForm').submit(function (e) {
        e.preventDefault();
        handleSale('finalizar_venta');
    });

    // Función para manejar la venta
    function handleSale(action) {
        const productos = [];
        $('#salesTable tbody tr').each(function () {
            const product = $(this).find('td:eq(0)').text();
            const quantity = $(this).find('td:eq(2)').text();
            const price = $(this).find('td:eq(3)').text();
            const total = $(this).find('td:eq(4)').text();
            const iva = $(this).find('td:eq(5)').text();
            productos.push({
                nombre: product,
                cantidad: quantity,
                precio: price,
                total: total,
                iva: iva
            });
        });

        const data = {
            action: action,
            productos: JSON.stringify(productos),
            cliente: $('#customer').val(),
            total: $('#grandTotal').val(),
            totalIVA: $('#totalIVA').val()
        };

        $.post('sales-controller.php', data, function (response) {
            alert(response);
            if (action === 'finalizar_venta') {
                $('#salesTable tbody').empty();
                updateTotals();
            }
        });
    }

    // Función para actualizar los totales
    function updateTotals() {
        let totalIVA = 0;
        let grandTotal = 0;

        $('#salesTable tbody tr').each(function () {
            const iva = parseFloat($(this).find('td:eq(5)').text());
            const totalWithIva = parseFloat($(this).find('td:eq(6)').text());

            totalIVA += iva;
            grandTotal += totalWithIva;
        });

        $('#totalIVA').val(totalIVA.toFixed(2));
        $('#grandTotal').val(grandTotal.toFixed(2));
    }
});
