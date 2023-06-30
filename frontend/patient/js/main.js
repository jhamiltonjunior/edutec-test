const cpf = document.querySelector('#cpf')
const userName = document.querySelector('#name')
const specialtyID = document.querySelector('#specialty')

const sendData = document.querySelector('.button')
const invalidCPF = document.querySelector('.invalid-cpf')
const invalidName = document.querySelector('.invalid-name')
const specialty = document.querySelector('.specialty')
const successScreen = document.querySelector('.success-screen')

const formLogin = document.querySelector('#login')

formLogin.addEventListener('submit', async event => {
  event.preventDefault()

  if (cpf.value.length < 11 || cpf.value.length > 11) {
    cpf.style.borderColor = '#fd0000'
    invalidCPF.style.display = 'inline-block'
  }

  if (userName.value.length <= 0 || userName.value.length > 255) {
    userName.style.borderColor = '#fd0000'
    invalidName.style.display = 'inline-block'
  }

  if (
    cpf.value.length === 11 && userName.value.length > 0
  ) {
    const response = loginOrCreateAccount(cpf.value, userName.value)

    // console.log(response)

    cleanForm()

    // console.log(await response)

    const firstName = userName.value.split(' ')[0]

    if (await response === 'Account created') {
      const text = document.createTextNode(`
      Como você não tinha uma conta em nosso banco de dado criamos uma para você,
      ${firstName}
      `)

      welcomeUser(text)

      createSelectSpecialtyElement()

      return
    }

    const text = document.createTextNode(`
        Bem vindo(a) de volta, ${firstName}!
      `)

    welcomeUser(text)

    createSelectSpecialtyElement()
  }

})

const welcomeUser = (newAccount) => {
  const h2 = document.createElement('h2')

  h2.appendChild(newAccount)

  specialty.appendChild(h2)
}

const createSelectSpecialtyElement = async () => {

  const response = await searchSpecialty()

  // console.log(response)

  const labelSpecialty = document.createElement('label')
  labelSpecialty.appendChild(document.createTextNode('Especialidade'))  

  const selectSpecialty = document.createElement('select')
  selectSpecialty.classList.add('select-specialty')
  
  



  response.map((_, index, array) => {
    const option = document.createElement('option')

    const name = document.createTextNode(`${array[index][1]}`)

    option.appendChild(name)

    option.classList.add('button')
    option.classList.add('button-specialty')


    selectSpecialty.appendChild(option)
  })

  specialty.appendChild(labelSpecialty)
  specialty.appendChild(selectSpecialty)


  selectSpecialty.addEventListener('click', async (event) => {

    // if (document.querySelector('.remove-it')) {
    //   console.log('oi')
    //   document.querySelectorAll('.remove-it').forEach(
    //     (value) => value.remove()
    //   )
    // }

    const professional = await searchProfessional(event.target.value)

    const selectProfessional = document.querySelector('.select-professional')
    selectProfessional.disabled = false

    while (selectProfessional.firstChild) {
      selectProfessional.firstChild.remove()
    }

    professional.map((_, index, array) => {
      const option = document.createElement('option')

      const arrOfPrfessional = array[index][0]

      // console.log(arrOfPrfessional)
      // console.log(arrOfPrfessional !== undefined)

      if (arrOfPrfessional !== undefined) {
        const name = document.createTextNode(`${arrOfPrfessional[1]}`)

        option.appendChild(name)

        option.classList.add('button')
        option.classList.add('button-specialty')


        selectProfessional.appendChild(option)
      }
    })




  })

  const selectProfessional = document.createElement('select')
  const labelProfessional = document.createElement('label')


  selectProfessional.classList.add('select-professional')

  selectProfessional.required = true
  selectProfessional.disabled = true
  
  labelProfessional.appendChild(document.createTextNode('Profissional'))
  
  specialty.appendChild(labelProfessional)
  specialty.appendChild(selectProfessional)

  const titles = ['Atendimento (1/10)', 'Pontualidade (1/10)', 'Recepção (1/10)', 'Infraestrutura (1/10)']
  const classNames = ['punctuality', 'service', 'front-desk', 'infrastructure']

  for (let i = 0; i < titles.length; i++) {
    const inputRange = document.createElement('input')
    const label = document.createElement('label')

    inputRange.classList.add('remove-it')
    label.classList.add('remove-it')

    inputRange.type = 'range'
    inputRange.min = 1
    inputRange.max = 10
    inputRange.step = 1

    inputRange.value = 1
    inputRange.classList.add(`${classNames[i]}`)


    label.appendChild(document.createTextNode(`${titles[i]}`))

    specialty.appendChild(label)
    specialty.appendChild(inputRange)
  }

  const labelTextarea = document.createElement('label')

  specialty.appendChild(labelTextarea)
  labelTextarea.appendChild(document.createTextNode('Feedback'))

  const textarea = document.createElement('textarea')

  textarea.placeholder = 'Deixe o seu feedback'
  textarea.classList.add('textarea')
  textarea.required = true

  specialty.appendChild(textarea)


  const sendFeedback = document.createElement('button')

  sendFeedback.innerHTML = 'Pronto'
  sendFeedback.classList.add('button')
  sendFeedback.classList.add('button-specialty')

  specialty.appendChild(sendFeedback)
}



specialty.addEventListener('submit', async (event) => {
  event.preventDefault()
  const feedback = document.querySelector('.textarea')
  const selectProfessional = document.querySelector('.select-professional')
  const selectSpecialty = document.querySelector('.select-specialty')
  
  const service = document.querySelector('.service').value
  const punctuality = document.querySelector('.punctuality').value
  const frontDesk = document.querySelector('.front-desk').value
  const infrastructure = document.querySelector('.infrastructure').value


  const average = (Number(service) + Number(punctuality) + Number(frontDesk) + Number(infrastructure))/ 4

  console.log(average)


  const specialtyValue = selectSpecialty.options[selectSpecialty.selectedIndex].value
  if (selectProfessional.length !== 0){
    const professionalValue = selectProfessional.options[selectProfessional.selectedIndex].value
    
    const response = createGrade(
      cpf.value, professionalValue, specialtyValue, Number(service), Number(punctuality), Number(frontDesk), Number(infrastructure), average, String(feedback.value)
    )

    if (await response === 'success') {
      specialty.style.display = 'none'

      successScreen.style.display = 'block'
    }

    console.log(await response)


  } else {
    alert('Escolha o profissional!')
  }



})

const cleanForm = () => {
  formLogin.style.display = 'none'
  specialty.style.display = 'flex'
}

