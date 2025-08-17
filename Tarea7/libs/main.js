// Estado de la aplicación
let currentUser = null;
let currentScreen = 'login';
let isValidator = false;

// Datos simulados
const incidentsData = {
    accident1: {
        title: 'Choque múltiple en Autopista Duarte',
        type: 'Accidente',
        description: 'Accidente de tránsito involucra 3 vehículos en la autopista, generando tapón vehicular extenso.',
        location: 'Santiago, Autopista Duarte KM 45',
        deaths: 2,
        injured: 5,
        losses: 2500000,
        date: '2024-08-17 14:30',
        coordinates: '19.4519, -70.6971'
    },
    robbery1: {
        title: 'Asalto a banco en Zona Colonial',
        type: 'Robo',
        description: 'Individuos armados asaltan sucursal bancaria durante horario comercial.',
        location: 'Distrito Nacional, Zona Colonial',
        deaths: 0,
        injured: 2,
        losses: 8700000,
        date: '2024-08-17 12:15',
        coordinates: '18.4781, -69.8938'
    }
};

const locationData = {
    'distrito-nacional': {
        municipalities: ['Distrito Nacional'],
        neighborhoods: {
            'Distrito Nacional': ['Zona Colonial', 'Piantini', 'Naco', 'Bella Vista', 'Gascue']
        }
    },
    'santo-domingo': {
        municipalities: ['Santo Domingo Este', 'Santo Domingo Norte', 'Santo Domingo Oeste', 'Boca Chica'],
        neighborhoods: {
            'Santo Domingo Este': ['Los Mina', 'San Isidro', 'Ozama', 'Los Alcarrizos'],
            'Santo Domingo Norte': ['Villa Mella', 'Pantoja', 'Sabana Grande'],
            'Santo Domingo Oeste': ['Herrera', 'Palmarejo', 'Los Alcarrizos']
        }
    },
    'santiago': {
        municipalities: ['Santiago', 'Licey al Medio', 'Tamboril', 'Villa González'],
        neighborhoods: {
            'Santiago': ['Centro Histórico', 'Gurabo', 'Cienfuegos', 'Los Jardines'],
            'Licey al Medio': ['Centro', 'Los Rieles']
        }
    }
};

// Funciones de navegación
function showScreen(screenId) {
    const screens = ['loginScreen', 'validatorLoginScreen', 'mainScreen', 'reportScreen', 'validatorScreen'];
    screens.forEach(id => {
        document.getElementById(id).style.display = 'none';
    });
    document.getElementById(screenId).style.display = 'block';
    currentScreen = screenId.replace('Screen', '');
}

function showLogin() {
    showScreen('loginScreen');
}

function showValidatorLogin() {
    showScreen('validatorLoginScreen');
}

function showDashboard() {
    if (isValidator) {
        showScreen('validatorScreen');
    } else {
        showScreen('mainScreen');
    }
    updateActiveNavLink('Mapa Principal');
}

function showIncidentsList() {
    showScreen('mainScreen');
    updateActiveNavLink('Lista de Incidencias');
}

function showReportForm() {
    showScreen('reportScreen');
}

function updateActiveNavLink(linkText) {
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('active');
        if (link.textContent === linkText) {
            link.classList.add('active');
        }
    });
}

// Funciones de autenticación
function loginWithGoogle() {
    currentUser = {
        name: 'María Rodríguez',
        email: 'maria.rodriguez@gmail.com',
        provider: 'Gmail'
    };
    isValidator = false;
    showNotification('¡Bienvenida María! Has iniciado sesión con Gmail', 'success');
    setTimeout(() => showDashboard(), 1500);
}

function loginWithMicrosoft() {
    currentUser = {
        name: 'Carlos Martínez',
        email: 'carlos.martinez@outlook.com',
        provider: 'Office 365'
    };
    isValidator = false;
    showNotification('¡Bienvenido Carlos! Has iniciado sesión con Office 365', 'success');
    setTimeout(() => showDashboard(), 1500);
}

// Login de validador
document.getElementById('validatorLoginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const user = document.getElementById('validatorUser').value;
    const password = document.getElementById('validatorPassword').value;
    
    if (user === 'admin' && password === 'admin123') {
        currentUser = {
            name: 'Administrador',
            email: 'admin@incidenciasrd.gov.do',
            role: 'validator'
        };
        isValidator = true;
        showNotification('Acceso autorizado al panel de validación', 'success');
        setTimeout(() => showScreen('validatorScreen'), 1500);
    } else {
        showNotification('Credenciales incorrectas', 'error');
    }
});

// Funciones del mapa
function toggleMapView() {
    showNotification('Vista de mapa cambiada', 'info');
}

function centerMap() {
    showNotification('Mapa centrado en República Dominicana', 'info');
}

function toggleClustering() {
    showNotification('Clustering de marcadores activado/desactivado', 'info');
}

// Modal de incidencias
function showIncidentModal(incidentId) {
    const incident = incidentsData[incidentId];
    if (!incident) return;

    document.getElementById('modalTitle').textContent = incident.title;
    document.getElementById('modalBody').innerHTML = `
        <div style="margin-bottom: 20px;">
            <span class="incident-type type-${incident.type.toLowerCase()}">${incident.type}</span>
        </div>
        <p><strong>Descripción:</strong> ${incident.description}</p>
        <p><strong>📍 Ubicación:</strong> ${incident.location}</p>
        <p><strong>📅 Fecha:</strong> ${incident.date}</p>
        <p><strong>📍 Coordenadas:</strong> ${incident.coordinates}</p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 15px; margin: 20px 0;">
            <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 1.5em;">💀</div>
                <div style="font-weight: bold;">${incident.deaths}</div>
                <div style="font-size: 0.9em; color: #666;">Muertos</div>
            </div>
            <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 1.5em;">🏥</div>
                <div style="font-weight: bold;">${incident.injured}</div>
                <div style="font-size: 0.9em; color: #666;">Heridos</div>
            </div>
            <div style="text-align: center; padding: 15px; background: #f8f9fa; border-radius: 8px;">
                <div style="font-size: 1.5em;">💰</div>
                <div style="font-weight: bold;">RD$ ${incident.losses.toLocaleString()}</div>
                <div style="font-size: 0.9em; color: #666;">Pérdidas</div>
            </div>
        </div>
    `;
    document.getElementById('incidentModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('incidentModal').style.display = 'none';
}

function addComment() {
    const commentText = document.getElementById('newComment').value.trim();
    if (commentText) {
        const commentsContainer = document.getElementById('comments');
        const newComment = document.createElement('div');
        newComment.style.cssText = 'background: #e3f2fd; padding: 15px; border-radius: 8px; margin-bottom: 10px; border-left: 4px solid #1e3c72;';
        newComment.innerHTML = `
            <strong>${currentUser.name}:</strong> ${commentText}
            <div style="color: #666; font-size: 0.9em; margin-top: 5px;">Ahora mismo</div>
        `;
        commentsContainer.appendChild(newComment);
        document.getElementById('newComment').value = '';
        showNotification('Comentario agregado exitosamente', 'success');
    }
}

function showCorrectionForm() {
    alert('Funcionalidad de correcciones - En desarrollo\n\nPermitirá sugerir cambios en:\n• Número de muertos/heridos\n• Ubicación\n• Pérdidas estimadas\n• Coordenadas');
}

// Funciones del formulario de reporte
function updateMunicipalities() {
    const provinceSelect = document.getElementById('incidentProvince');
    const municipalitySelect = document.getElementById('incidentMunicipality');
    const neighborhoodSelect = document.getElementById('incidentNeighborhood');
    
    const selectedProvince = provinceSelect.value;
    
    municipalitySelect.innerHTML = '<option value="">Seleccione un municipio</option>';
    neighborhoodSelect.innerHTML = '<option value="">Seleccione un barrio</option>';
    
    if (selectedProvince && locationData[selectedProvince]) {
        locationData[selectedProvince].municipalities.forEach(municipality => {
            const option = document.createElement('option');
            option.value = municipality.toLowerCase().replace(/\s+/g, '-');
            option.textContent = municipality;
            municipalitySelect.appendChild(option);
        });
    }
}

function updateNeighborhoods() {
    const provinceSelect = document.getElementById('incidentProvince');
    const municipalitySelect = document.getElementById('incidentMunicipality');
    const neighborhoodSelect = document.getElementById('incidentNeighborhood');
    
    const selectedProvince = provinceSelect.value;
    const selectedMunicipality = municipalitySelect.options[municipalitySelect.selectedIndex].text;
    
    neighborhoodSelect.innerHTML = '<option value="">Seleccione un barrio</option>';
    
    if (selectedProvince && locationData[selectedProvince] && selectedMunicipality) {
        const neighborhoods = locationData[selectedProvince].neighborhoods[selectedMunicipality];
        if (neighborhoods) {
            neighborhoods.forEach(neighborhood => {
                const option = document.createElement('option');
                option.value = neighborhood.toLowerCase().replace(/\s+/g, '-');
                option.textContent = neighborhood;
                neighborhoodSelect.appendChild(option);
            });
        }
    }
}

// Manejo del formulario de reporte
document.getElementById('reportIncidentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validar que al menos un tipo esté seleccionado
    const checkedTypes = document.querySelectorAll('input[name="incidentType"]:checked');
    if (checkedTypes.length === 0) {
        showNotification('Debe seleccionar al menos un tipo de incidencia', 'error');
        return;
    }
    
    // Simular envío del reporte
    showNotification('Reporte enviado para validación. Recibirá una notificación cuando sea aprobado.', 'success');
    
    // Limpiar formulario
    document.getElementById('reportIncidentForm').reset();
    
    // Volver al dashboard después de un momento
    setTimeout(() => showDashboard(), 2000);
});

// Funciones del panel de validador
function showValidatorDashboard() {
    // Ya está visible, solo actualizar active
}

function showStatistics() {
    alert('Estadísticas del Sistema\n\n📊 Reportes del mes:\n• Accidentes: 245\n• Robos: 189\n• Desastres: 34\n• Peleas: 156\n\n📈 Tendencias:\n• 15% aumento en accidentes\n• 8% reducción en robos\n• Picos los fines de semana');
}

function showCatalogs() {
    alert('Gestión de Catálogos\n\n🏛️ Funcionalidades disponibles:\n• Gestión de Provincias\n• Gestión de Municipios\n• Gestión de Barrios\n• Tipos de Incidencias\n\n✨ Próximamente: Interfaz completa de administración');
}

function showTab(tabName) {
    // Actualizar botones de pestañas
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    // Simular cambio de contenido
    const messages = {
        pending: 'Mostrando reportes pendientes de validación',
        approved: 'Mostrando reportes aprobados hoy',
        corrections: 'Mostrando sugerencias de corrección'
    };
    showNotification(messages[tabName], 'info');
}

function approveReport(reportId) {
    if (confirm('¿Está seguro de que desea aprobar este reporte?')) {
        showNotification(`Reporte #${reportId} aprobado y publicado`, 'success');
        // Simular eliminación del reporte de la lista
        event.target.closest('.report-item').style.opacity = '0.5';
        event.target.closest('.report-item').innerHTML += '<div style="background: #d4edda; padding: 10px; border-radius: 5px; margin-top: 10px; color: #155724;"><strong>✅ APROBADO</strong> - Reporte publicado en el sistema</div>';
    }
}

function editReport(reportId) {
    alert(`Editando reporte #${reportId}\n\n🔧 Funcionalidades de edición:\n• Modificar título y descripción\n• Ajustar números de víctimas\n• Corregir ubicación\n• Actualizar pérdidas estimadas\n• Cambiar coordenadas\n\n💾 Los cambios serán guardados automáticamente`);
}

function rejectReport(reportId) {
    const reason = prompt('¿Por qué motivo rechaza este reporte?\n\nRazones comunes:\n- Información insuficiente\n- Duplicado\n- Fuente no confiable\n- Datos incorrectos');
    
    if (reason) {
        showNotification(`Reporte #${reportId} rechazado. Motivo: ${reason}`, 'info');
        event.target.closest('.report-item').style.opacity = '0.5';
        event.target.closest('.report-item').innerHTML += `<div style="background: #f8d7da; padding: 10px; border-radius: 5px; margin-top: 10px; color: #721c24;"><strong>❌ RECHAZADO</strong> - ${reason}</div>`;
    }
}

// Funciones de filtros
function applyFilters() {
    const search = document.getElementById('searchInput').value;
    const province = document.getElementById('provinceFilter').value;
    const type = document.getElementById('typeFilter').value;
    const date = document.getElementById('dateFilter').value;
    
    let filterMessage = 'Aplicando filtros: ';
    const filters = [];
    
    if (search) filters.push(`Búsqueda: "${search}"`);
    if (province) filters.push(`Provincia: ${province}`);
    if (type) filters.push(`Tipo: ${type}`);
    if (date) filters.push(`Fecha: ${date}`);
    
    filterMessage += filters.length > 0 ? filters.join(', ') : 'Sin filtros';
    showNotification(filterMessage, 'info');
}

// Función de logout
function logout() {
    if (confirm('¿Está seguro de que desea cerrar sesión?')) {
        currentUser = null;
        isValidator = false;
        showNotification('Sesión cerrada exitosamente', 'info');
        showLogin();
    }
}

// Función para mostrar notificaciones
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const colors = {
        success: '#d4edda',
        error: '#f8d7da',
        info: '#d1ecf1',
        warning: '#fff3cd'
    };
    const textColors = {
        success: '#155724',
        error: '#721c24',
        info: '#0c5460',
        warning: '#856404'
    };
    
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        background: ${colors[type]};
        color: ${textColors[type]};
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        z-index: 2000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
        font-weight: 600;
        border-left: 4px solid ${textColors[type]};
        max-width: 300px;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);

    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 4000);
}

// Funciones de inicialización
function initApp() {
    // Establecer fecha actual en el formulario de reporte
    const now = new Date();
    const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    document.getElementById('incidentDate').value = localDateTime;
    
    // Establecer fecha actual en filtro
    document.getElementById('dateFilter').value = now.toISOString().slice(0, 10);
    
    // Simular actualizaciones en tiempo real
    setInterval(updateStats, 30000);
    
    // Efecto de escritura en el logo
    animateLogo();
}

function updateStats() {
    // Simular cambios en las estadísticas
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const currentValue = parseInt(stat.textContent);
        const variation = Math.floor(Math.random() * 3) - 1; // -1, 0, o 1
        const newValue = Math.max(0, currentValue + variation);
        stat.textContent = newValue.toString();
    });
}

function animateLogo() {
    const logo = document.querySelector('.logo h1');
    if (logo) {
        const text = logo.textContent;
        logo.textContent = '';
        let i = 0;
        const timer = setInterval(() => {
            logo.textContent += text[i];
            i++;
            if (i >= text.length) {
                clearInterval(timer);
                // Agregar la bandera después
                logo.innerHTML += ' <span class="rd-flag"></span>';
            }
        }, 100);
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    initApp();
    
    // Cerrar modal al hacer click fuera
    document.getElementById('incidentModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Navegación con teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    
    // Búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        if (query.length > 2) {
            showNotification(`Buscando: "${query}"`, 'info');
        }
    });
    
    // Validación en tiempo real del formulario
    const formInputs = document.querySelectorAll('#reportIncidentForm input, #reportIncidentForm select, #reportIncidentForm textarea');
    formInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.required && !this.value) {
                this.style.borderColor = '#f56565';
            } else {
                this.style.borderColor = '#48bb78';
            }
        });
    });
});

// Simulación de notificaciones push
function simulatePushNotifications() {
    const notifications = [
        'Nueva incidencia reportada en Santo Domingo',
        'Reporte validado y publicado',
        'Actualización en incidencia que estás siguiendo',
        'Comentario nuevo en reporte cercano a tu ubicación'
    ];
    
    setInterval(() => {
        if (currentUser && Math.random() > 0.8) {
            const randomNotification = notifications[Math.floor(Math.random() * notifications.length)];
            showNotification(randomNotification, 'info');
        }
    }, 45000); // Cada 45 segundos
}

// Geolocalización (simulada)
function requestLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('incidentLat').value = position.coords.latitude.toFixed(6);
                document.getElementById('incidentLng').value = position.coords.longitude.toFixed(6);
                showNotification('Ubicación detectada automáticamente', 'success');
            },
            function() {
                showNotification('No se pudo obtener la ubicación automáticamente', 'warning');
            }
        );
    }
}

// Agregar botón de geolocalización
setTimeout(() => {
    const latInput = document.getElementById('incidentLat');
    if (latInput) {
        const locationBtn = document.createElement('button');
        locationBtn.type = 'button';
        locationBtn.innerHTML = '📍 Usar mi ubicación';
        locationBtn.style.cssText = 'margin-top: 10px; padding: 8px 16px; background: #48bb78; color: white; border: none; border-radius: 5px; cursor: pointer;';
        locationBtn.onclick = requestLocation;
        latInput.parentNode.appendChild(locationBtn);
    }
}, 1000);

// Iniciar simulaciones
setTimeout(simulatePushNotifications, 5000);

// Función de demostración para el video
function runDemo() {
    console.log('🎬 Iniciando demostración automática...');
    
    // Secuencia de demostración
    setTimeout(() => showNotification('Bienvenido a IncidenciasRD - Sistema Nacional de Reportes', 'info'), 1000);
    setTimeout(() => showNotification('Prototipo funcional con navegación completa', 'success'), 3000);
    setTimeout(() => showNotification('Datos simulados para demostración', 'warning'), 5000);
}

// Ejecutar demo automáticamente
setTimeout(runDemo, 2000);