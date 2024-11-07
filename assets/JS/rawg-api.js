//Crea una instancia de cliente para la API
const RawgAPI = function(apiKey) {     
    const BASE_URL = `https://api.rawg.io/api/games?key=${apiKey}`; //URL de la API con la apikey

    //Construccion de la URL de la API con los parametros
    const url = (params) => {
        //Construye la URL de la API completa
        return BASE_URL + '&' + Object.entries(params).map(([key, value]) => `${key}=${value}`).join('&');
    }
    //Solicitud a API para obtener los juegos y los devuelve en json ordenados por metacritic
    const get = async (ordering = '-metacritic') => {    
        const response = await fetch(url({ ordering }));    //Construye la url con el parametro de ordenamiento

        const json = await response.json(); //Obtiene los datos json y los guarda

        return json;
    }

    return {
        get
    }
}
//Crea una instancia de cliente de la API pasando la apikey por parametro
window.rawgClient = new RawgAPI('0b5088394abd4598a7cdf4fe193ec594');