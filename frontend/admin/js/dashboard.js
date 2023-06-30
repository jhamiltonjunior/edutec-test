const selectDataForm = document.querySelector('.select-data-form')
const specialty = document.querySelector('.button-specialty')
const professional = document.querySelector('.button-professional')
const conProfessional = document.querySelector('.button-con-professioanl')
const wrapper = document.querySelector('.select-data-wrapper')
const editData = document.querySelector('.edit-data ul')

selectDataForm.addEventListener('submit', event => {
  event.preventDefault()

  wrapper.classList.add('disabled')


  
  
})

specialty.addEventListener('click', async () => {
  const response = await readSpecialty()
  response.map((_, index, array) => {
    const li = document.createElement('li')
    const button = document.createElement('button')
    const img1 = document.createElement('img')
    const img2 = document.createElement('img')

    const name = document.createTextNode(`${array[index][1]}`)

    img1.src = 'img/edit.png'
    img2.src = 'img/delete.png'

    button.classList.add('button')


    li.appendChild(name)
    li.appendChild(button)
    button.appendChild(img1)
    button.appendChild(img2)

    // option.classList.add('button')
    // option.classList.add('button-specialty')


    editData.appendChild(li)
  })
  console.log(await response)
  console.log('oi')
})