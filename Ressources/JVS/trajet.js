const map = L.map('map').setView([48.8566, 2.3522], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

let markers = [];
let routeLayer = null;

map.on('click', function(e) {
    if (markers.length === 2) {
        markers.forEach(m => map.removeLayer(m));
        markers = [];
        if (routeLayer) map.removeLayer(routeLayer);
    }

    const marker = L.marker(e.latlng).addTo(map);
    markers.push(marker);

    if (markers.length === 2) {
        calculerTrajet();
    }
});

function calculerTrajet() {
    const p1 = markers[0].getLatLng();
    const p2 = markers[1].getLatLng();

    const url = `https://router.project-osrm.org/route/v1/driving/${p1.lng},${p1.lat};${p2.lng},${p2.lat}?overview=full&geometries=geojson`;

    fetch(url)
        .then(res => res.json())
        .then(data => {
            const route = data.routes[0];

            const distanceKm = (route.distance / 1000).toFixed(1);
            const dureeMin = Math.round(route.duration / 60);

            document.getElementById('distance').textContent = distanceKm;
            document.getElementById('duration').textContent = dureeMin;

            document.getElementById('distance_km').value = distanceKm;
            document.getElementById('duree_minutes').value = dureeMin;
            document.getElementById('route_index').value = 0;

            afficherHeureArrivee(dureeMin);
            afficherTrajet(route.geometry);
        });
}

function afficherTrajet(geojson) {
    routeLayer = L.geoJSON(geojson).addTo(map);
    map.fitBounds(routeLayer.getBounds());
}

function afficherHeureArrivee(dureeMin) {
    const depart = new Date();
    depart.setMinutes(depart.getMinutes() + dureeMin);

    document.getElementById('arrival').textContent =
        depart.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
}
