const BASE_URL = 'http://localhost:8080'

const login = async (cpf, password) => {
  const data = {
    "cpf": `${cpf}`,
    "password": `${password}`,
  }

  const params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
    body: JSON.stringify(data)
  }

  try {
    const response = await fetch(`${BASE_URL}/admin/login.php`, params)
    // console.log(await response.json())
    return response.json()
  } catch (error) {
    console.log(error)
  }
}

// const searchSpecialty = async () => {
//   const params = {
//     method: "GET",
//     headers: {
//       "Content-Type": "application/json; charset=utf-8"
//     },
//   }

//   try {
//     const response = await fetch(`${BASE_URL}/specialty.php`, params)

//     // console.log(await response.json())

//     return response.json()
//   } catch (error) {
//     console.log(error, 'oi')
//   }
// }

// const searchProfessional = async (specialty) => {
//   const data = {
//     "specialty": `${specialty}`
//   }

//   const params = {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json; charset=utf-8"
//     },
//     body: JSON.stringify(data)
//   }

//   try {
//     const response = await fetch(`${BASE_URL}/professional.php`, params)

//     // console.log(await response.json())

//     return response.json()
//   } catch (error) {
//     console.log(error)
//   }
// }


// const createGrade = async (cpf, professional, specialty, service, punctuality, frontDesk, infrastructure, feedback) => {
//   const data = {
//     "cpf": `${cpf}`,
//     "professional": `${professional}`,
//     "specialty": `${specialty}`,
//     "service": `${service}`,
//     "punctuality": `${punctuality}`,
//     "frontDesk": `${frontDesk}`,
//     "infrastructure": `${infrastructure}`,
//     "feedback": `${feedback}`
//   }

//   const params = {
//     method: "POST",
//     headers: {
//       "Content-Type": "application/json;"
//     },
//     body: JSON.stringify(data)
//   }

//   try {
//     const response = await fetch(`${BASE_URL}/grade.php`, params)
//     console.log(await response.json())
//     return response.json()
//   } catch (error) {
//     console.log(error)
//   }
// }
