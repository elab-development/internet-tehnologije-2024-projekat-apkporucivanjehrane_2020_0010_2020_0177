import { useState, useEffect } from 'react';
import axios from 'axios';

const useApi = (url, dependencies = []) => {
  const [podaci, setPodaci] = useState(null);
  const [ucitavanje, setUcitavanje] = useState(true);
  const [greska, setGreska] = useState(null);

  useEffect(() => {
    const fetchPodaci = async () => {
      try {
        setUcitavanje(true);
        setGreska(null);
        
        const response = await axios.get(url);
        setPodaci(response.data);
        setUcitavanje(false);
      } catch (err) {
        setGreska(err.response?.data?.message || 'Greška pri učitavanju podataka');
        setUcitavanje(false);
      }
    };

    if (url) {
      fetchPodaci();
    }
  }, dependencies);

  return { podaci, ucitavanje, greska };
};

export default useApi;

