import { api } from '@/modules/api.js';

export async function fetchContacts() {
  const url = '/api/chat/contacts';
  const contacts = await api(url);

  return contacts;
}

export function sortBy(array, prop) {
  return array.sort((a, b) => a[prop] - b[prop]);
}

function validContactData(data) {
  let isValid = data;

  return isValid;
}

export default { fetchContacts }