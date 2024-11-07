//Funcion asincrona que obtiene los datos de la API para mostrarlos en la tabla
(async () => {
    //Propiedad results se asigna a games
    const { results: games } = await rawgClient.get();  //Espera que se complete la solicitud HTTP a la API

    const tableBody = document.getElementById('games-table');   //Asigna a tablebody la tabla

    games
        .filter(({ background_image }) => background_image) //Filtra los juegos por los que tengan imagen
        .slice(0, 19) // Obtener los primeros 19 juegos
        .forEach((game, index) => { //Crea la tabla y la rellena, recorre games
            const row = document.createElement('tr');

            //Inserta el indice
            const indexCell = document.createElement('td');
            indexCell.textContent = (index + 1).toString(); 
            indexCell.classList.add('align-middle'); // Agrega la clase CSS de Bootstrap
            row.appendChild(indexCell);

            //Inserta la imagen
            const imageCell = document.createElement('td');
            const image = document.createElement('img'); 
            image.src = game.background_image;
            image.alt = game.name;
            image.style.width = '80px';
            image.style.height = '80px';
            imageCell.appendChild(image);
            row.appendChild(imageCell);

            //Inserta el nombre del juego
            const nameCell = document.createElement('td');
            nameCell.textContent = game.name;
            nameCell.classList.add('align-middle'); // Agrega la clase CSS de Bootstrap
            row.appendChild(nameCell);

            //Inserta la valoracion metacritic
            const metacriticCell = document.createElement('td');
            metacriticCell.textContent = game.metacritic.toString();
            metacriticCell.classList.add('text-center', 'align-middle'); // Agrega las clases CSS de Bootstrap
            row.appendChild(metacriticCell);

            //Agrega la fila como elemento hijo de games-table
            tableBody.appendChild(row);
        });
})();
