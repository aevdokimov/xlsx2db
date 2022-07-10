import './bootstrap';

const channel = Echo.channel('rows');
const echoLog = document.querySelector('#echo-log');

channel.listen('.RowCreated', (data) => {
    echoLog.insertAdjacentHTML('afterbegin', 'row created: ' + JSON.stringify(data.model)+'<br/>')
});

channel.listen('.App\\Events\\RowsNotification', (data) => {
    echoLog.insertAdjacentHTML('afterbegin', data.message + '<br/>')
});