const BASE_URL = 'http://localhost:8080'

const loginOrCreateAccount = async (cpf, name) => {
  const data = {
    "cpf": `${cpf}`,
    "name": `${name}`,
  }

  const params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
    body: JSON.stringify(data)
  }

  try {
    const response = await fetch(`${BASE_URL}/patient/index.php`, params)
    // console.log(await response.json())
    return response.json()
  } catch (error) {
    console.log(error)
  }
}

const searchSpecialty = async () => {
  const params = {
    method: "GET",
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
  }

  try {
    const response = await fetch(`${BASE_URL}/patient/specialty.php`, params)

    // console.log(await response.json())

    return response.json()
  } catch (error) {
    console.log(error, 'oi')
  }
}

const searchProfessional = async (specialty) => {
  const data = {
    "specialty": `${specialty}`
  }

  const params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8"
    },
    body: JSON.stringify(data)
  }

  try {
    const response = await fetch(`${BASE_URL}/patient/professional.php`, params)

    // console.log(await response.json())

    return response.json()
  } catch (error) {
    console.log(error)
  }
}


const createGrade = async (cpf, professional, specialty, service, punctuality, frontDesk, infrastructure, average,feedback) => {
  const data = {
    "cpf": `${cpf}`,
    "professional": `${professional}`,
    "specialty": `${specialty}`,
    "service": `${service}`,
    "punctuality": `${punctuality}`,
    "frontDesk": `${frontDesk}`,
    "infrastructure": `${infrastructure}`,
    "average": `${average}`,
    "feedback": `${feedback}`
  }

  const params = {
    method: "POST",
    headers: {
      "Content-Type": "application/json;"
    },
    body: JSON.stringify(data)
  }

  try {
    const response = await fetch(`${BASE_URL}/patient/grade.php`, params)
    // console.log(await response.json())
    return response.json()
  } catch (error) {
    console.log(error)
  }
}
