
        // Store data array organized by division, district, and sub-district
        const stores = [
            {
                name: 'মোহাম্মাদিয়া ভ্যারাইটিজ স্টোর',
                address: 'ঢাকা-পাবনা হাইওয়ে, আতাইকুলা, পাবনা',
                phone: '০১৭০৭৬৯৫১৭৭',
                division: 'রাজশাহী',
                district: 'পাবনা',
                subdistrict: 'পাবনা সদর',
                lat: 40.7128,
                lon: -74.0060
            },
            {
                name: 'শরিফ অ্যাগ্রো স্টোর',
                address: 'আয়ুব আলী রোড, দৌলতপুর, খুলনা',
                phone: '০১৭০৭৮৬৫৪৩২',
                division: 'খুলনা',
                district: 'খুলনা',
                subdistrict: 'দৌলতপুর',
                lat: 34.0522,
                lon: -118.2437
            },
            {
                name: 'আব্দুল্লাহ স্টোর',
                address: 'কোপাল মাকবরা রোড, Jessore সদর, Jessore',
                phone: '০১৭২১১২২২২',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1626,
                lon: 89.2170
            },
            {
                name: 'নাসির ট্রেডার্স',
                address: 'রাজবাড়ী রোড, Jessore, Khulna',
                phone: '০১৮১২৩৪৫৬৭৮',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1692,
                lon: 89.2110
            },
            {
                name: 'নতুন সেবা স্টোর',
                address: 'বাউলিয়া বাজার, Jessore শহর, Jessore',
                phone: '০১৭৯৮৭৬৫৪৩',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1680,
                lon: 89.2100
            },
            {
                name: 'জেসিন্স ইলেকট্রনিক্স',
                address: 'মোল্লাপাড়া রোড, Jessore, Khulna',
                phone: '০১৮১২৩৪৫৬৭৯',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1750,
                lon: 89.2135
            },
            {
                name: 'বাজার স্টোর',
                address: 'সোমপুর বাজার, Jessore, Khulna',
                phone: '০১৭৩৬৭৫৪২৮',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1600,
                lon: 89.2185
            },
            {
                name: 'কৃষি বাজার',
                address: 'পশ্চিমপাড়া, Jessore, Khulna',
                phone: '০১৮৩৪৫৬৭৮৯',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1740,
                lon: 89.2205
            },
            {
                name: 'মসজিদ মার্কেট',
                address: 'ফুলতলা, Jessore, Khulna',
                phone: '০১৭১৫৪৩২১০',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1687,
                lon: 89.2202
            },
            {
                name: 'ফাহিম ট্রেডার্স',
                address: 'কদমতলা বাজার, Jessore, Khulna',
                phone: '০১৭২৪৫৩৪৬৭',
                division: 'Khulna',
                district: 'Jessore',
                subdistrict: 'Jessore Sadar',
                lat: 23.1705,
                lon: 89.2198
            }
        ];
        

        // Initialize the map with a default view on Mymensingh and add a marker
        const defaultLat = 23.2334, defaultLon = 89.1254;
        var map = L.map('map').setView([defaultLat, defaultLon], 10);

        // Set up the OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Add marker for default Mymensingh location
        L.marker([defaultLat, defaultLon]).addTo(map)
            .bindPopup(`<strong>যবিপ্রবি</strong><br/>আমবটতলা, যশোর`)
            .openPopup();

        // Show all stores on the map
        function showAllStores() {
            map.setView([defaultLat, defaultLon], 5);

            // Clear previous markers
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Add markers for all stores
            stores.forEach(store => {
                L.marker([store.lat, store.lon]).addTo(map)
                    .bindPopup(`<strong>${store.name}</strong><br/>${store.address}`);
            });

            // Reset dropdowns and show full list in table
            document.getElementById('division-select').value = '';
            document.getElementById('district-select').value = '';
            document.getElementById('subdistrict-select').value = '';
            updateStoreList(stores);
            document.getElementById('district-select').disabled = true;
            document.getElementById('subdistrict-select').disabled = true;
        }

        // Populate division dropdown
        function populateDropdowns() {
            const divisions = [...new Set(stores.map(store => store.division))];
            const divisionSelect = document.getElementById('division-select');
            divisions.forEach(division => {
                const option = document.createElement('option');
                option.value = division;
                option.textContent = division;
                divisionSelect.appendChild(option);
            });
        }

        // Populate district dropdown based on division selection
        function populateDistricts() {
            const division = document.getElementById('division-select').value;
            const districtSelect = document.getElementById('district-select');
            districtSelect.innerHTML = '<option value="">Select District</option>';
            document.getElementById('subdistrict-select').innerHTML = '<option value="">Select Sub-District</option>';

            if (division) {
                districtSelect.disabled = false;
                const districts = [...new Set(stores.filter(store => store.division === division).map(store => store.district))];
                districts.forEach(district => {
                    const option = document.createElement('option');
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            } else {
                districtSelect.disabled = true;
                document.getElementById('subdistrict-select').disabled = true;
            }
        }

        // Populate sub-district dropdown based on district selection
        function populateSubdistricts() {
            const district = document.getElementById('district-select').value;
            const subdistrictSelect = document.getElementById('subdistrict-select');
            subdistrictSelect.innerHTML = '<option value="">Select Sub-District</option>';

            if (district) {
                subdistrictSelect.disabled = false;
                const subdistricts = [...new Set(stores.filter(store => store.district === district).map(store => store.subdistrict))];
                subdistricts.forEach(subdistrict => {
                    const option = document.createElement('option');
                    option.value = subdistrict;
                    option.textContent = subdistrict;
                    subdistrictSelect.appendChild(option);
                });
            } else {
                subdistrictSelect.disabled = true;
            }
        }

        // Filter store list based on dropdown selections
        function filterStores() {
            const division = document.getElementById('division-select').value;
            const district = document.getElementById('district-select').value;
            const subdistrict = document.getElementById('subdistrict-select').value;

            const filteredStores = stores.filter(store =>
                (!division || store.division === division) &&
                (!district || store.district === district) &&
                (!subdistrict || store.subdistrict === subdistrict)
            );

            updateStoreList(filteredStores);
        }

        // Update store list based on filtered results
        function updateStoreList(filteredStores) {
            const storeListBody = document.getElementById('store-list-body');
            storeListBody.innerHTML = "";
            filteredStores.forEach(store => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="p-3 border-b">${store.name}</td>
                    <td class="p-3 border-b">${store.address}</td>
                    <td class="p-3 border-b">${store.phone}</td>
                    <td class="p-3 border-b">
                        <span class="cursor-pointer text-blue-500 hover:text-blue-700" onclick="updateMap(${store.lat}, ${store.lon}, '${store.name}', '${store.address}')">&#128506;</span>
                    </td>
                `;
                storeListBody.appendChild(row);
            });
        }

        // Smoothly scroll to the map section and update the map view
        function updateMap(lat, lon, name, address) {
            map.setView([lat, lon], 13);

            // Clear previous markers
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Add a new marker with store name and address in popup
            L.marker([lat, lon]).addTo(map)
                .bindPopup(`<strong>${name}</strong><br/>${address}`)
                .openPopup();

            // Smooth scroll to the map
            document.getElementById("map").scrollIntoView({ behavior: "smooth", block: "start" });
        }

        // Initialize dropdowns and store list
        populateDropdowns();
        updateStoreList(stores);
    

