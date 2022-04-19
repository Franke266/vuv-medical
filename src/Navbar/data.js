//import React, { useState, useEffect } from 'react'
import * as FaIcons from 'react-icons/fa'
import { FaPills } from "react-icons/fa";
import { FaComments } from "react-icons/fa";

export const SidebarData = [
  {
    title: 'Pregledi',
    path: 'pregledip',
    icon: <FaIcons.FaRegClipboard />,
  },

  {
    title: 'Uputnice',
    path: 'uputnicep',
    icon: <FaIcons.FaRegClipboard />,
  },

  {
    title: 'Lijekovi',
    path: '/lijekovip',
    icon: <FaPills />,
  },
  {
    title: 'Poruke',
    path: '/porukep',
    isLoged: false,
    icon: <FaComments />,
  },
]
