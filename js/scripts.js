    document.addEventListener('DOMContentLoaded', function() {
    const trackButton = document.getElementById('trackButton');
    const trackingInput = document.getElementById('trackingInput');
    const trackingInfo = document.getElementById('trackingInfo');

    trackButton.addEventListener('click', function() {
        const trackingNumber = trackingInput.value;
        fetchTrackingData(trackingNumber);
    });

    function fetchTrackingData(trackingNumber) {
        // Simulate fetching tracking data
        const mockData = {
            '123456': 'Package is in transit',
            '654321': 'Package has been delivered',
            '789012': 'Package is out for delivery'
        };

        const result = mockData[trackingNumber] || 'Tracking number not found';
        updateTrackingInfo(result);
    }

    function updateTrackingInfo(message) {
        trackingInfo.textContent = message;
    }
});