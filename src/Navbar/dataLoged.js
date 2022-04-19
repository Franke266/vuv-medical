//import React, { useState, useEffect } from 'react'
import * as FaIcons from 'react-icons/fa'
import { FaPills } from "react-icons/fa";
import { FaComments } from "react-icons/fa";

export const SidebarDataWhenLoged = [
  {
    title: 'Pacijenti',
    path: '/',
    icon: <FaIcons.FaUserAlt />,
  },

  /*{
    title: 'Osoblje',
    dropdown: true,
    icon: <IoIcons.IoMdPeople />,
    iconClosed: <RiIcons.RiArrowDownSFill />,
    iconOpened: <RiIcons.RiArrowUpSFill />,
    subNav: [
      {
        title: 'Opća obiteljska medicina',
        path: '/osoblje/opca-obiteljska-medicina',
      },
      {
        title: 'Zdravstvena zaštita žena',
        path: '/osoblje/zdravstvena-zastita-zena',
      },
      {
        title: 'Stomatologija',
        path: '/osoblje/stomatologija',
      },
      {
        title: 'Pedijatrija',
        path: '/osoblje/pedijatrija',
      },
    ],
  },*/
  {
    title: 'Pregledi',
    path: '/pregledi',
    icon: <FaIcons.FaRegClipboard />,
  },
  {
    title: 'Uputnice',
    path: '/uputnice',
    icon: <FaIcons.FaRegClipboard />,
  },
  {
    title: 'Lijekovi',
    path: '/lijekovi',
    icon: <FaPills />,
  },
  {
    title: 'Poruke',
    path: '/poruke',
    icon: <FaComments />,
  },
  /*{
    title: 'Dodaj djelatnika',
    path: '/administracija/dodaj',
    icon: <TiIcons.TiUserAdd />,
  },*/
]
