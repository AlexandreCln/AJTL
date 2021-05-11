export function getUserList() {
  const users = [
    { id: 3, name: 'Izuku Midoriya with long name' },
    { id: 4, name: 'Izuku Midoriya', photoSrc: 'https://static.cnews.fr/sites/default/files/styles/image_640_360/public/my_hero_academia_saison_5_adn_27_mars-taille1200_605b77c1d777a.jpg?itok=VEVVmGeW' },
    { id: 5, name: 'Izuku Midoriya' },
    { id: 2, name: 'Head Eraser', online: true, photoSrc: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTg9mqCf25uQk9-NSiF9N1Gzrp4bN26utTyyg&usqp=CAU' },
    { id: 8, name: 'Izuku Midoriya', photoSrc: 'https://placekitten.com/50/50' },
    { id: 6, name: 'Izuku Midoriya', photoSrc: 'https://placekitten.com/50/50' },
    { id: 1, name: 'AllMight', online: true, photoSrc: 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/7d13c5f2-28c5-468e-9d9b-f0048ce7921b/ddroud5-85e234ab-8862-410b-874d-e0fac37fee02.png/v1/fill/w_400,h_400,q_80,strp/all_might_square_by_isaacnoeliscutie_ddroud5-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3siaGVpZ2h0IjoiPD00MDAiLCJwYXRoIjoiXC9mXC83ZDEzYzVmMi0yOGM1LTQ2OGUtOWQ5Yi1mMDA0OGNlNzkyMWJcL2Rkcm91ZDUtODVlMjM0YWItODg2Mi00MTBiLTg3NGQtZTBmYWMzN2ZlZTAyLnBuZyIsIndpZHRoIjoiPD00MDAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.RNzfDwMzg1yyhXnLkUKk3xVHcqPZNdff8iPcDa6aW8k' },
    { id: 10, name: 'Izuku Midoriya', photoSrc: 'https://placekitten.com/51/50' },
    { id: 7, name: 'Izuku Midoriya', photoSrc: 'https://placekitten.com/50/50' },
    { id: 11, name: 'Izuku Midoriya', photoSrc: 'https://placekitten.com/100/100' },
    { id: 9, name: 'Izuku Midoriya' },
    { id: 12, name: 'Izuku Midoriya' },
  ]

  return users.sort((a, b) => a.id - b.id);
}

export function toto() {
  console.log('hello world');
}

export default { getUserList, toto }